package main

import (
	"net/http"

	"github.com/go-chi/chi"
	templatehandler "project-exercise/arch/internal/handler/http/product"
)

func newRoutes(templateHandler *templatehandler.templateHandler) *chi.Mux {
	router := chi.NewRouter()

	router.MethodFunc(http.MethodGet, "/v1/book", templateHandler.GetTemplates)
	router.MethodFunc(http.MethodPost, "/v1/book", templatehandler.)

	return router
}
