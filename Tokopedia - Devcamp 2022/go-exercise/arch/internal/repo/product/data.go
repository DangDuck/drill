package product

import (
	entity "project-exercise/arch/internal/entity/product"
)

var templates = []entity.Template{
	{
		ID:          1,
		Name:        "Mie Sedap",
		Description: "Mie Sedap dari Wings Food",
		UnitPrice:   3200,
		Stock:       1000,
		Discount:    0,
	}, {
		ID:          2,
		Name:        "Indomie",
		Description: "Indomie dari IndoFoods",
		UnitPrice:   3500,
		Stock:       1000,
		Discount:    200,
	},
}

var variants = []entity.Variant{
	{
		ID:          1,
		TemplateID:  2,
		VariantName: "Goreng",
		Description: "Indomie Goreng",
		UnitPrice:   2500,
		Stock:       200,
		Discount:    100,
	},
	{
		ID:          2,
		TemplateID:  2,
		VariantName: "Rendang",
		Description: "Indomie Rendang",
		UnitPrice:   2600,
		Stock:       100,
		Discount:    0,
	},
}
