<script setup lang="ts">
import { Task } from "../../Types/task";

const emits = defineEmits<{
    (
        event: "handleTaskStatus",
        value: number,
        status: string,
        type?: string
    ): void;
    (event: "handleTaskEdit", id: number, value: string): void;
    (event: "handleTaskDelete", id: number): void;
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
                    <v-menu>
                        <template v-slot:activator="{ props }">
                            <v-btn
                                v-bind="props"
                                append-icon="mdi-dots-vertical"
                                rounded=""
                                size="md"
                                class="pa-2"
                                variant="text"
                            />
                        </template>

                        <v-list bg-color="#836FFF">
                            <v-list-item>
                                <v-list-item-title
                                    ><v-btn
                                        v-if="task.status == 'created'"
                                        variant="text"
                                        @click="
                                            emits(
                                                'handleTaskEdit',
                                                task.id,
                                                task.title
                                            )
                                        "
                                        >EDIT</v-btn
                                    >
                                </v-list-item-title>
                                <v-list-item-title>
                                    <v-btn
                                        variant="text"
                                        @click="
                                            emits('handleTaskDelete', task.id)
                                        "
                                        >DELETE</v-btn
                                    >
                                </v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </div>
            </v-card>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
