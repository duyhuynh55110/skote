import { map } from 'rxjs';
import { useGlobalStore } from "@/stores/global.store"
import { identity } from "@/services/auth.service"

export default defineNuxtRouteMiddleware(async () => {
    if(process.server) { return; }

    const store = useGlobalStore()
    if(store.initialAuth) return

    // firebase fetch API to get current user inform
    await identity().pipe(
        map(
            () => { store.initialAuth = true; }
        )
    ).toPromise();
})
