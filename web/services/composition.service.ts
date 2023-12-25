import { DEFAULT_PER_PAGE } from "@/enum/constants";
import { map, from, of, catchError } from "rxjs";
import type { Category, Paginator, Product } from "@/types";

const GET_HOMEPAGE_DATA = gql`
  query ($perPage: Int!, $page: Int!) {
    getCategories {
      slug_name
      name
      full_path_image
    }
    getPopularProducts: getProducts(first: $perPage, page: $page) {
      data {
        slug_name
        name
        full_path_image
        item_price
      }
    }
    getRecentlyProducts: getProducts(first: 3, page: 1) {
      data {
        slug_name
        name
        full_path_image
        description
      }
    }
    getTrendingProducts: getProducts(first: 3, page: 2) {
      data {
        slug_name
        name
        full_path_image
        description
      }
    }
    getTopSellingProducts: getProducts(first: 3, page: 3) {
      data {
        slug_name
        name
        full_path_image
        description
      }
    }
  }
`;

interface HomepageData {
    getCategories: Category[],
    getPopularProducts: Paginator<Product>,
    getRecentlyProducts: Paginator<Product>,
    getTrendingProducts: Paginator<Product>,
    getTopSellingProducts: Paginator<Product>,
}

// get products list
export const getHomepageData = async () => {
  // fetching data for SSR
  return from(
    of(
      await useAsyncQuery<HomepageData>(GET_HOMEPAGE_DATA, {
        page: 1,
        perPage: DEFAULT_PER_PAGE,
      })
    )
  ).pipe(
    map(res => res),
    catchError(
        e => {
            throw 'error in source. Details: ' + e;
        } 
    )
  );
};
