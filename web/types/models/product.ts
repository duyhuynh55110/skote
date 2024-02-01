import type { Brand } from "./brand"
import type { Category } from "./category"

export interface Product {
    slug_name: string
    name: string
    full_path_image: string
    item_price: number
    description?: string
    summary_rating?: number
    count_rating?: number
    brand?: Brand
    categories?: Category[]
}
