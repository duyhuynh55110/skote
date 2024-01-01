enum RowTypes {
    brand,
    product,
}

export interface SearchItem {
    slug_name: string
    name: string
    full_path_image: string
    item_price?: number
    row_type: RowTypes
}
