<template>
    <UIProvider>
        <!-- TopBar -->
        <PartialTopBar /> 

        <!-- Page content -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <slot />
                </div>
            </div>
        </div>

        <!-- Footer -->
        <PartialFooter /> 
    </UIProvider>
</template>

<script setup lang="ts">
</script>