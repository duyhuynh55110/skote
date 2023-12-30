export interface PaginatorInfo {
    // Index of the current page.
    current_page: number

    // Number of items per page.
    per_page: number

    // Number of total available items.
    total: number

    // Number of items in the current page.
    count?: number
    
    // Index of the first item in the current page.
    first_item?: number

    // Are there more pages after this one?
    has_more_pages?: boolean

    // Index of the last item in the current page.
    last_item?: number

    // Index of the last available page.
    last_page: number
}

export interface Paginator<T> {
    data: T[]
    paginatorInfo?: PaginatorInfo
}
