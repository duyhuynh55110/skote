<template>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18"> {{ $t(title) }} </h4>                            
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
    const props = defineProps({
        title: {
            type: String,
            required: true,
        }
    })
</script>