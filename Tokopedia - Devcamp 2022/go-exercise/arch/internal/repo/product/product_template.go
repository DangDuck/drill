package product

import (
	entity "project-exercise/arch/internal/entity/product"
)

type templateRng interface {
	Int63() int64
}

type templateRepo struct {
	templateRng templateRng
}

func templateNew(templateRng templateRng) (*templateRepo, error) {
	return &templateRepo{
		templateRng: templateRng,
	}, nil
}

func (r *templateRepo) GetTemplates() ([]entity.Template, error) {
	return templates, nil
}

func (r *templateRepo) Create(template entity.Template) (entity.Template, error) {
	template.ID = r.templateRng.Int63()
	templates = append(templates, template)

	return template, nil
}
