<template>
    <div id="layout-wrapper">
        <PartialTopBar /> 

        <!-- Page content -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <slot />
                </div>
            </div>
        </div>
        
        <PartialFooter /> 
    </div>
</template>