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
    query ($perPage: Int!, $page: Int!, $orderBy: Int!) {
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
            }
        }
    }
`;

interface QueryProducts {
    getProducts: Paginator<Product>
}

// get products list
export const getProducts = async (page: number, orderBy: number, perPage: number = DEFAULT_PER_PAGE) => {
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
