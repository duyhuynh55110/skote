import { lastValueFrom, map } from 'rxjs';
import { useGlobalStore } from "@/stores/global.store"
import { identity } from "@/services"

export default defineNuxtRouteMiddleware(async () => {
    // only fetch user from client
    if(process.server) { return; }

    const store = useGlobalStore()
    if(store.initialAuth) return

    // firebase fetch API to get current user inform
    const identity$ = identity().pipe(
        map(
            () => { store.initialAuth = true; }
        )
    );

    await lastValueFrom(identity$);
})
