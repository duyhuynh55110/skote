/**
 * Relations docs
 * 
 * Fetch data for SSR 
 * https://apollo.nuxtjs.org/getting-started/composables#useasyncquery
 */

import { map, from, of, catchError } from 'rxjs'
import { DEFAULT_PER_PAGE } from '@/enum/constants'
import type { Paginator, Product } from '@/types';

const GET_PRODUCTS = gql`
    query ($perPage: Int!, $page: Int!, $orderBy: String!) {
        getProducts(first: $perPage, page: $page, order_by: $orderBy) {
            data {
                slug_name,
                name,
                full_path_image,
                item_price
            },
            paginatorInfo {
                per_page
                current_page
                total
                last_page
            }
        }
    }
`;

const GET_PRODUCT_BY_SLUG_NAME = gql`
    query ($slugName: String!) {
        getProductBySlugName(slug_name: $slugName) {
            slug_name
            name
            item_price
            full_path_image
            summary_rating
            count_rating
            description
            brand {
                slug_name
                name
            }
            categories {
                slug_name
                name
            }
        }
    }
`;

interface QueryProducts {
    getProducts: Paginator<Product>
}

// get products list
export const getProducts = async (page: number, orderBy: string, perPage: number = DEFAULT_PER_PAGE) => {
    // fetching data for SSR
    return from(of(
        await useAsyncQuery<QueryProducts>(GET_PRODUCTS, {
            page,
            perPage,
            orderBy
        })
    ))
    .pipe(
        map(res => res),
        catchError(
            e => {
                throw 'error in source. Details: ' + e;
            } 
        )
    );
}

interface QueryGetProductBySlugName {
    getProductBySlugName: Product
}

// get product detail by slug_name
export const getProductBySlugName = async (slugName: string) => {
    return from(of(
        await useAsyncQuery<QueryGetProductBySlugName>(GET_PRODUCT_BY_SLUG_NAME, {
            slugName
        })
    ))
    .pipe(
        map(res => res),
        catchError(
            e => {
                throw 'error in source. Details: ' + e;
            } 
        )
    );
}
