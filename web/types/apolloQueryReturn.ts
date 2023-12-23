import type { ApolloQueryResult } from "@apollo/client";
import type { Category } from "./category";

export interface AQRGetCategories extends ApolloQueryResult<{
    getCategories: Category[],
}> {}
