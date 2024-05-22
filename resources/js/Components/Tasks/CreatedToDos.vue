<script setup lang="ts">
import { Task } from "../../Types/task";

const props = defineProps<{
    tasks: Array<Task>;
}>();
</script>

<template>
    <div>
        <div v-for="task in tasks" :key="task.id">
            <v-card class="my-2" variant="tonal" id="dragItem">
                <v-card-title>
                    {{ task.title }}
                </v-card-title>
            </v-card>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
