package product

import "fmt"

type Variant struct {
	ID          int64  `json:"id"`
	TemplateID  int64  `json:"template_id"`
	VariantName string `json:"variant_name"`
	Description string `json:"description"`
	UnitPrice   int    `json:"unit_price"`
	Stock       int    `json:"stock"`
	Discount    int    `json:"discount"`
}

// Nama produk: Indomie
// Deskripsi: Indomie
// Varian:
// - Varian: goreng
// Harga: 3000
// Stok: 100
// Diskon: 100
// - Varian: rendang
// Harga: 4000
// Stok: 10
// Diskon: 200

// Validate return error if book's properties are not valid
func (v *Variant) Validate() error {
	switch {
	case v.VariantName == ``:
		return fmt.Errorf(`Variant Name is empty`)
	case v.TemplateID < 0:
		return fmt.Errorf(`Main Product is empty`)
	default:
		return nil
	}
}
