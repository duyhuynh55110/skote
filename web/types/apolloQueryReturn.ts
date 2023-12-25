import type { ApolloQueryResult } from "@apollo/client";
import type { Category } from "./models/category";

export interface AQRGetCategories extends ApolloQueryResult<{
    getCategories: Category[],
}> {}
