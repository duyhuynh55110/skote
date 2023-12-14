import { useGlobalStore } from "@/stores/global.store"
import { identity } from "@/services/auth.service"
import { map } from "rxjs"

export default defineNuxtRouteMiddleware(async () => {
    const store = useGlobalStore()
    if(store.initialAuth) return

    // // firebase fetch API to get current user inform
    await identity()
    .pipe(
        map(
            () => { store.initialAuth = true; }
        )
    )
    .toPromise();
})