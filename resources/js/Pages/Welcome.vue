<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div
        class="bg-[#211951] min-h-screen text-[#F0F3FF] grid place-items-center"
    >
        <div class="">
            <div class="mb-4">
                <p class="text-2xl font-bold">Jira knockOFF</p>
                <div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit
                    <br />
                    Ducimus, libero. Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Harum, quisquam.
                </div>
            </div>
            <header>
                <nav v-if="canLogin" class="">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="bg-[#15F5BA]"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="bg-[#15F5BA] p-2 rounded text-[#211951] mr-2"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="bg-[#15F5BA] p-2 rounded text-[#211951]"
                        >
                            Register
                        </Link>
                    </template>
                </nav>
            </header>
        </div>
    </div>
</template>
