/**
 * Relations docs
 * 
 * Fetch data for SSR 
 * https://apollo.nuxtjs.org/getting-started/composables#useasyncquery
 */

import { map, from, of } from 'rxjs'
import { DEFAULT_PER_PAGE } from '@/enum/constants'

const GET_PRODUCTS = gql`
    query ($perPage: Int!, $page: Int!) {
        getProducts(first: $perPage, page: $page) {
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

// get products list
export const getProducts = async (page: number, perPage: number = DEFAULT_PER_PAGE) => {
    // fetching data for SSR
    return from(of(
        await useAsyncQuery(GET_PRODUCTS, {
            page,
            perPage
        })
    )).pipe(
        map(({ data }) => data)
    );
}
