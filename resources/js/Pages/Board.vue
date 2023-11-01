<script setup>
import {DotsHorizontalIcon, PencilIcon, PlusIcon, ArrowNarrowLeftIcon} from "@heroicons/vue/solid";
import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue';
import CardList from "./CardList.vue";
import Authenticated from '@/Layouts/Authenticated.vue';

const props = defineProps({

    board: Object, //obtiene los datos de la BD,  "board" es el $board que se encuentra en la función show del BoardController.
    //card: Object para traer directo del controller
});

</script>

<template>
        <Authenticated>
            <div class="flex flex-col h-screen bg-gray-600">
            
            <main class="flex-1 overflow-hidden">
                <a class="inline-flex items-center bg-white/20 hover:bg-white/30 px-3 py-2 font-medium text-sm text-white rounded-md" 
                    :href="`/sprints/${board.backlog_id}`">
                    <ArrowNarrowLeftIcon class="w-6 h-6"/>
                    
                </a>
                <div class="flex flex-col h-full">
                    <div class="shrink-0 flex justify-between items-center p-4">
                        <h1 class="text-2xl text-white font-bold">{{props.board.name}}</h1>
                        
                        

                    </div>

                    <div class="flex-1 overflow-x-auto">
                        <div class="inline-flex h-full items-start px-4 pb-4 space-x-4">
                            <!-- CardList.vue -->
                        <CardList
                            v-for="list in board.lists" 
                            :key="list.id"
                            :list="list"
                            class="w-72 bg-gray-200 max-h-full flex flex-col rounded-md">
                        </CardList>
                            <!-- CardList.vue -->
                       
                        </div>
                    </div>
                </div>
            </main>
        </div>
        </Authenticated>
</template>