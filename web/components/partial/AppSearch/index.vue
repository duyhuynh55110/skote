<template>
    <form class="app-search d-lg-block">
        <div class="position-relative">
            <input type="text" class="form-control" placeholder="Search..." v-model="searchText" @keyup="filterRecords" />
            <span class="bx bx-search-alt"></span>

            <!-- Records list -->
            <div class="position-absolute w-100 bg-white">
                <div v-if="!isFetching">
                    <div v-if="searchItemsData.length > 0" class="items-list">
                        <RecordItem v-for="item in searchItemsData" :key="item.slug_name" :searchItem="item" />
                    </div>
                    <div v-else>
                        <div class="p-4 text-center">
                            Not found
                        </div>
                    </div>
                </div>
                <!-- Show records list -->
                <div v-else>
                    <div class="items-list">
                        <RecordItem />
                        <RecordItem />
                    </div>
                </div>
                <!-- Fetching data -->
            </div>
        </div>
    </form>
</template>

<style lang="scss">
    .items-list {
        .item {
            cursor: pointer;
             
            &:hover {
                background: #f8f9fa;
                // color: var(--bs-dropdown-link-active-bg);
            }
        }
    }

    @media (min-width: 600px) {
        .app-search {
            min-width: 350px;
        }
    }
</style>

<script setup lang="ts">
    import { getSearchMultipleItems } from "@/services";
    import type { SearchItem } from '@/types';
    import RecordItem from "./RecordItem.vue"

    const searchText = ref('');
    const isFetching = ref(false);
    const searchItemsData = ref<SearchItem[]>([]);

    // API fetch search multiple items list
    const fetchSearchMultipleItems = async () => {
        if(!searchText.value) {
            return;
        }
        // show isFetching animation
        isFetching.value = true;

        const abortController = new AbortController();
        (await getSearchMultipleItems(searchText.value, 1, abortController, 5)).subscribe({
            next: ({ data }) => {
                const { getSearchMultipleItems } = data.value;
                
                searchItemsData.value = getSearchMultipleItems.data;
            },
            complete: () => {
                isFetching.value = false;
            }
        })
    } 

    // event when keyup in search box
    const filterRecords = async (event: any) => {
        // don't fetch API when key is 
        // if(event.key === 'Backspace') {
        //     return;
        // }

        await fetchSearchMultipleItems();
    }
</script>