import { from, of, switchMap, Subject, Observable } from 'rxjs'
import type { AQRGetCategories } from '@/types/apolloQueryReturn';

const GET_CATEGORIES = gql`
    {
        getCategories {
            slug_name
            name
            full_path_image
        }
    } 
`;

// get categories list
export const getCategories = (): Observable<any> => {
    const { refetch } = useQuery(GET_CATEGORIES); 

    return from(of(refetch())).pipe(
        // active promise fetch data
        switchMap((result: Promise<AQRGetCategories> | any) => {
            // Process the data and return an observable
            return result;
        }),
    )
}
