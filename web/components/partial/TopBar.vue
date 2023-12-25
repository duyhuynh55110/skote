<template>
    <div>
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <NuxtLink to="/" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="@/assets/images/logo-light.svg" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="@/assets/images/logo-light.png" alt="" height="19">
                            </span>
                        </NuxtLink>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="bx bx-search-alt"></span>
                        </div>
                    </form>
                </div>

                <div class="d-flex">
                    <div class="dropdown d-inline-block d-lg-none ml-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-search-dropdown">
                            
                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="" src="@/assets/images/flags/us.jpg" alt="Header Language" height="16">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="@/assets/images/flags/spain.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Spanish</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="@/assets/images/flags/germany.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">German</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="@/assets/images/flags/italy.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Italian</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="@/assets/images/flags/russia.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Russian</span>
                            </a>
                        </div>
                    </div>

                    <ClientOnly>
                        <div class="dropdown d-inline-block">
                            <div v-if="!currentUser">
                                <button type="button" class="btn header-item waves-effect" @click.once="() => navigateTo('/login')">
                                    <i class="fas fa-sign-in-alt"></i>
                                    {{ $t('SIGN_IN') }}
                                </button>
                            </div>
                            <!-- Sign In/Register -->

                            <div v-else class="dropdown d-inline-block">
                                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img class="rounded-circle header-profile-user" src="@/assets/images/users/avatar-1.jpg"
                                        alt="Header Avatar">
                                    <span class="d-none d-xl-inline-block ms-1"> {{ currentUser.phoneNumber }} </span>
                                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                                </button>
                                <!-- Button open dropdown -->

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="page-header-user-dropdown">
                                    <!-- item-->
                                    <button class="dropdown-item text-danger" @click.prevent.native="handleSignOut"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</button>
                                </div>
                                <!-- User's dropdown -->
                            </div>
                            <!-- User's profile -->
                        </div>  
                    </ClientOnly>
                </div>
            </div>
        </header>
        <!-- TopBar1 -->

        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.html">
                                    <i class="bx bx-home-circle mr-2"></i> {{ $t('DASHBOARD') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- TopBar2 -->
    </div>
</template>

<script setup lang="ts">
import { computed, type ComputedRef } from "vue" 
import { type User } from "firebase/auth"
import { signOut } from "@/services"
import { useAuthStore } from "@/stores/auth.store"

const authStore = useAuthStore()

// get current logged in user's inform
const currentUser:ComputedRef<User|null> = computed((): User|null => authStore.currentUser);

// handle when click 'Sign out' button
const handleSignOut = (): void => {
    signOut().subscribe()
}
</script>
