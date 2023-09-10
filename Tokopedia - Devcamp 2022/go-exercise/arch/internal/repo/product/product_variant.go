package product

import (
	entity "project-exercise/arch/internal/entity/product"
)

type variantRng interface {
	Int63() int64
}

type variantRepo struct {
	variantRng variantRng
}

func variantNew(variantRng variantRng) (*variantRepo, error) {
	return &variantRepo{
		variantRng: variantRng,
	}, nil
}

func (r *variantRepo) GetVariants() ([]entity.Variant, error) {
	return variants, nil
}

func (r *variantRepo) Create(variant entity.Variant) (entity.Variant, error) {
	variant.ID = r.variantRng.Int63()
	variants = append(variants, variant)

	return variant, nil
}
