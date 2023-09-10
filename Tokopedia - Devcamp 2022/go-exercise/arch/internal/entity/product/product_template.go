package product

import "fmt"

type Template struct {
	ID          int64  `json:"id"`
	Name        string `json:"name"`
	Description string `json:"description"`
	UnitPrice   int    `json:"unit_price"`
	Stock       int    `json:"stock"`
	Discount    int    `json:"discount"`
}

//Nama produk: Makanan ikan
//Deskripsi: bikin ikan kenyang
//Harga: 15000
//Stok: 50
//Diskon: 0

func (t *Template) Validate() error {
	switch {
	case t.Name == ``:
		return fmt.Errorf(`Name is empty`)
	case t.Description == ``:
		return fmt.Errorf(`Description is empty`)
	default:
		return nil
	}
}
