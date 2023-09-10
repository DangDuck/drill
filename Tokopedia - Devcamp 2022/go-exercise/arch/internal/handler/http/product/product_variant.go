package http

import (
	"encoding/json"
	"net/http"

	entity "project-exercise/arch/internal/entity/product"
)

type variantUsecase interface {
	GetVariants() ([]entity.Variant, error)
	Create(templateId int64, variantName string, description string, unitPrice int, stock int, discount int) (int64, error)
}

type variantHandler struct {
	variantUc variantUsecase
}

func New(variantUc variantUsecase) *variantHandler {
	return &variantHandler{
		variantUc: variantUc,
	}
}

func (h *variantHandler) GetVariants(w http.ResponseWriter, r *http.Request) {

	// call the usecase
	variant, err := h.variantUc.GetVariants()
	if err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		w.Write([]byte(`error from GetVariants`))
		return
	}
	w.WriteHeader(http.StatusOK)
	err = json.NewEncoder(w).Encode(variant)
	if err != nil {
		w.WriteHeader(http.StatusInternalServerError)
		w.Write([]byte(`failed to encode response`))
		return
	}
}

func (h *variantHandler) Create(w http.ResponseWriter, r *http.Request) {
	var reqBody entity.Variant
	defer r.Body.Close()
	// params decode
	err := json.NewDecoder(r.Body).Decode(&reqBody)
	if err != nil {
		w.WriteHeader(http.StatusBadRequest)
		return
	}

	// call the usecase
	id, err := h.variantUc.Create(reqBody.TemplateID, reqBody.VariantName, reqBody.Description, reqBody.UnitPrice, reqBody.Stock, reqBody.Discount)
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

type createVariantResponse struct {
	ID int `json:"id"`
}
