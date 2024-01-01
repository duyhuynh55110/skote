import { map, from, of, catchError } from 'rxjs'
import { DEFAULT_PER_PAGE } from '@/enum/constants'
import type { Paginator, SearchItem } from '@/types';

const GET_SEARCH_MULTIPLE_ITEMS = gql`
  query ($search: String!, $page: Int, $perPage: Int!) {
    getSearchMultipleItems(search: $search, page: $page, first: $perPage) {
      data {
        name
        slug_name
        full_path_image
        item_price
        row_type
      }
    }
  }
`;

interface QuerySearchItems {
  getSearchMultipleItems: Paginator<SearchItem>
}

// get search multiple items list
export const getSearchMultipleItems = async (search: string, page: number, perPage: number = DEFAULT_PER_PAGE) => {
    // fetching data for SSR
    return from(of(
        await useAsyncQuery<QuerySearchItems>(GET_SEARCH_MULTIPLE_ITEMS, {
            search,
            page,
            perPage,
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
