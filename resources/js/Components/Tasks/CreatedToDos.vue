<script setup lang="ts">
import { Task } from "../../Types/task";

const emits = defineEmits<{
    (
        event: "handleTaskStatus",
        value: number,
        status: string,
        type?: string
    ): void;
}>();

const props = defineProps<{
    tasks: Array<Task>;
}>();
</script>

<template>
    <div>
        <div v-for="task in tasks" :key="task.id">
            <v-card class="my-2" variant="tonal" :id="'task-' + task.id">
                <div class="flex justify-between align-center px-1">
                    <v-btn
                        v-if="
                            task.status == 'inProgress' || task.status == 'done'
                        "
                        prepend-icon="mdi-arrow-left-bold"
                        variant="text"
                        size="md"
                        class="pa-2"
                        @click="
                            emits(
                                'handleTaskStatus',
                                task.id,
                                task.status,
                                'rev'
                            )
                        "
                    />
                    <v-card-text
                        :class="task.status == 'done' ? 'line-through' : ''"
                    >
                        {{ task.title }}
                    </v-card-text>
                    <v-btn
                        v-if="
                            task.status == 'created' ||
                            task.status == 'inProgress'
                        "
                        prepend-icon="mdi-arrow-right-bold"
                        variant="text"
                        size="md"
                        class="pa-2"
                        @click="emits('handleTaskStatus', task.id, task.status)"
                    />
                </div>
            </v-card>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
