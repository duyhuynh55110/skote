<template>
    <ul class="pagination pagination-rounded justify-content-center mt-4 mb-2">
        <li :class="{ 'page-item': true, 'disabled': isFirstPage }"  @click="onClickFirstPage">
            <a class="page-link"><i class="mdi mdi-chevron-double-left"></i></a>
        </li>

        <li v-for="page in pages" :key="page.name" :class="{ 'page-item': true, 'active': currentPage === page.name }" @click="onClickPageName(page.name)">
            <a class="page-link"> {{ page.name }} </a>
        </li>
        
        <li :class="{ 'page-item': true, 'disabled': isLastPage }" @click="onClickLastPage">
            <a class="page-link"><i class="mdi mdi-chevron-double-right"></i></a>
        </li>
    </ul>
</template>

<script setup lang="ts">
// emits
const emit = defineEmits(['page-change'])

// props
const props = defineProps<{
    currentPage: number,
    lastPage: number,
}>();

// Check current page is first page or not
const isFirstPage = computed(() => props.currentPage == 1);

// Check current page is last page or not
const isLastPage = computed(() => props.currentPage == props.lastPage);

// Render page numbers
const pages = computed(() => {
    const range = [];
    let maxVisible = props.currentPage + 3;

    if(maxVisible > props.lastPage) {
        maxVisible = props.lastPage;
    }

    // before current page
    if(props.currentPage > 1) {
        let maxVisibleBeforePage = props.currentPage - 4; // Ex: current page is 5 -> before page is 4,3,2

        for (let i = props.currentPage - 1; i > maxVisibleBeforePage; i--) {
            // maximum pages display & must large than 0
            if(i === maxVisibleBeforePage || i <= 0) {
                break;
            }

            // add item to first of array
            range.unshift({
                name: i,
                isDisabled: true,
            })
        }
    }

    // after current page
    for (let i = props.currentPage; i <= maxVisible; i++) {
        range.push({
            name: i,
            isDisabled: i === props.currentPage // Cannot click button have same number with current page
        });
    }

    return range;
})

// event on click first page button
const onClickFirstPage = () => {
    emit('page-change', 1)
}

// event on click last page button
const onClickLastPage = () => {
    emit('page-change', props.lastPage)
}

// event on click page number
const onClickPageName = (page: number) => {
    emit('page-change', page)
}
</script>
