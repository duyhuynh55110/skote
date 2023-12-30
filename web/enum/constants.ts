export const CLOSE_TOAST_TIMEOUT = 5000
export const DEFAULT_PER_PAGE = 24

// order products list
export const ORDER_BY_NEWEST = 'newest';
export const ORDER_BY_TOP_SELLING = 'top_selling';
export const ORDER_BY_POPULAR = 'popular';
export const ORDER_BY_LOW_TO_HEIGHT = 'low_to_height';
export const ORDER_BY_HEIGHT_TO_LOW = 'height_to_low';
export const ORDER_PRODUCTS: { [key: string]: string } = {
    [ORDER_BY_NEWEST]: 'NEWEST',
    [ORDER_BY_TOP_SELLING]: 'TOP_SELLING',
    [ORDER_BY_POPULAR]: 'POPULAR',
    [ORDER_BY_LOW_TO_HEIGHT]: 'LOW_TO_HEIGHT',
    [ORDER_BY_HEIGHT_TO_LOW]: 'HEIGHT_TO_LOW',
}
