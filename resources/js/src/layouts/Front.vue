<!-- =========================================================================================
    File Name: Main.vue
    Description: Main layout
    ----------------------------------------------------------------------------------------
    Item Name: Vuesax Admin - VueJS Dashboard Admin Template
    Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="layout--main" :class="[{'app-page': isAppPage}]">

        <div :class="[contentAreaClass, {'show-overlay': bodyOverlay}]">

            <div id="content-overlay"></div>

            <div class="content-wrapper">

                <div class="router-view">
                    <div class="router-content" :class="{'mt-0': navbarType == 'hidden'}">

                        <div class="content-area__content">
                            <back-to-top bottom="5%" visibleoffset="500" v-if="!hideScrollToTop">
                                <vs-button icon-pack="feather" icon="icon-arrow-up" class="shadow-lg" />
                            </back-to-top>
                            <transition :name="routerTransition" mode="out-in">
                                <router-view @changeRouteTitle="changeRouteTitle"></router-view>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VxSidebar from '@/layouts/components/vx-sidebar/VxSidebar.vue';
    import TheNavbar from '../layouts/components/TheNavbar';
    import TheFooter from '../layouts/components/TheFooter';
    import themeConfig from '@/../themeConfig.js';
    import sidebarItems from "@/layouts/components/vx-sidebar/sidebarItems.js";
    import BackToTop from 'vue-backtotop'

    export default {
        data() {
            return {
                navbarType: themeConfig.navbarType || 'floating',
                navbarColor: themeConfig.navbarColor || '#fff',
                footerType: themeConfig.footerType || 'static',
                routerTransition: themeConfig.routerTransition || 'none',
                isNavbarDark: false,
                routeTitle: this.$route.meta.pageTitle,
                sidebarItems: sidebarItems,
                disableCustomizer: themeConfig.disableCustomizer,
                windowWidth: window.innerWidth, //width of windows
                hideScrollToTop: themeConfig.hideScrollToTop,
                disableThemeTour: themeConfig.disableThemeTour
            }
        },
        watch: {
            '$route'() {
                this.routeTitle = this.$route.meta.pageTitle;
            },
            isThemeDark(val) {
                if(this.navbarColor == "#fff" && val) {
                    this.updateNavbarColor("#10163a")
                }else {
                    this.updateNavbarColor("#fff")
                }
            },
        },
        computed: {
            isAppPage() {
                if(this.$route.path.includes('/apps/')) return true
                else return false
            },
            isThemeDark() { return this.$store.state.theme == 'dark' },
            sidebarWidth() {
                return this.$store.state.sidebarWidth;
            },
            bodyOverlay() {
                return this.$store.state.bodyOverlay;
            },
            contentAreaClass() {
                if(this.sidebarWidth == "default") return "content-area-default"
                else if(this.sidebarWidth == "reduced") return "content-area-reduced"
                else if(this.sidebarWidth) return "content-area-full"
            },
        },
        methods: {
            changeRouteTitle(title) {
                this.routeTitle = title;
            },
            updateNavbarColor(val) {
                this.navbarColor = val;
                if(val == "#fff") this.isNavbarDark = false
                else this.isNavbarDark = true
            },
            handleWindowResize(event) {
                this.windowWidth = event.currentTarget.innerWidth;
                this.setSidebarWidth();
            },
            setSidebarWidth() {
                if (this.windowWidth < 1200) {
                    this.$store.commit('TOGGLE_IS_SIDEBAR_ACTIVE', false)
                    this.$store.dispatch('updateSidebarWidth', 'no-sidebar')
                    this.disableThemeTour = true;
                }
                else if(this.windowWidth < 1200) {
                    this.$store.dispatch('updateSidebarWidth', 'reduced')
                }
                else {
                    this.$store.commit('TOGGLE_IS_SIDEBAR_ACTIVE', true)
                }
            },
            toggleHideScrollToTop(val) {
                this.hideScrollToTop = val;
            }
        },
        components: {
            VxSidebar,
            TheNavbar,
            TheFooter,
            BackToTop
        },
        created() {
            this.setSidebarWidth();
            if(this.navbarColor == "#fff" && this.isThemeDark) {
                this.updateNavbarColor("#10163a")
            }else {
                this.updateNavbarColor(this.navbarColor)
            }
        }
    }
</script>
