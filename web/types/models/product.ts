import type { Brand } from "./brand"

export interface Product {
    slug_name: string
    name: string
    full_path_image: string
    item_price: number
    description?: string
    brand?: Brand
}