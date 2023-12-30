// https://nuxt.com/docs/guide/directory-structure/utils

// set a request name by name & value
export const setRouteQuery = (queryParams: { [key: string]: any }) => {
    const route = useRoute();
    const router = useRouter();
    const query = route.query;

    // set value to URL
    router.push({
        query: { ...query, ...queryParams },
    })
}
