package http

import (
	"encoding/json"
	"net/http"

	entity "project-exercise/arch/internal/entity/product"
)

type templateUsecase interface {
	GetTemplates() ([]entity.Template, error)
	Create(name string, description string, unitPrice int, stock int, discount int) (int64, error)
}

type templateHandler struct {
	templateUc templateUsecase
}

func templateNew(templateUc templateUsecase) *templateHandler {
	return &templateHandler{
		templateUc: templateUc,
	}
}

func (h *templateHandler) GetTemplates(w http.ResponseWriter, r *http.Request) {

	// call the usecase
	template, err := h.templateUc.GetTemplates()
	if err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		w.Write([]byte(`error from GetTemplates`))
		return
	}
	w.WriteHeader(http.StatusOK)
	err = json.NewEncoder(w).Encode(template)
	if err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		w.Write([]byte(`failed to encode response`))
		return
	}
}

func (h *templateHandler) Create(w http.ResponseWriter, r *http.Request) {
	var reqBody entity.Template
	defer r.Body.Close()
	// params decode
	err := json.NewDecoder(r.Body).Decode(&reqBody)
	if err != nil {
		w.WriteHeader(http.StatusBadRequest)
		return
	}

	// call the usecase
	id, err := h.templateUc.Create(reqBody.Name, reqBody.Description, reqBody.UnitPrice, reqBody.Stock, reqBody.Discount)
	if err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		w.Write([]byte(`error from Create`))
		return
	}
	response := map[string]int64{
		"id": id,
	}
	w.WriteHeader(http.StatusOK)
	json.NewEncoder(w).Encode(response)
	if err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		w.Write([]byte(`failed to encode response`))
		return
	}
}

type createTemplateResponse struct {
	ID int `json:"id"`
}
