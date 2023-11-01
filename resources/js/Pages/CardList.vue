<script setup>
import {DotsHorizontalIcon, PencilIcon, PlusIcon} from "@heroicons/vue/solid";
import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue';
import CardListItem from "./CardListItem.vue";
import Draggable from "vuedraggable";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    list: Object
});

const cards = ref(props.list.cards);

watch(() => props.list.cards, (newCards) => cards.value = newCards);

function onChange(e)
{
    let item = e.added || e.moved;
    if(!item) return;

    let index = item.newIndex;
    let prevCard= cards.value[index - 1];
    let nextCard= cards.value[index + 1];
    let card= cards.value[index];

    let position = card.position;

    if(prevCard && nextCard) {
        position = (prevCard.position + nextCard.position) / 2;
    } else if (prevCard) {
        position = prevCard.position + (prevCard.position /2);
    } else if(nextCard) {
        position = nextCard.position / 2;
    }

    Inertia.put(route('cards.move', {card: card.id}), {
        position: position,
        boardListId: props.list.id
    });


    console.log(e);
}
</script>

<template>
    <div>
                            <div class="flex items-center justify-between px-3 py-2">
                                <h3 class="text-sm font-semibold text-gray-700">{{list.name}}</h3>

                    
                            </div>
                            <div class="pb-3 flex flex-col overflow-hidden">
                            <div class="px-3 flex-1 overflow-y-auto">

                                <Draggable 
                                    v-model="cards" 
                                    group="cards" 
                                    item-key="id"
                                    class="space-y-3"
                                    tag="ul"
                                    drag-class="drag"
                                    ghost-class="ghost"
                                    @change="onChange"
                                    >
                                    <template #item="{element}">
                                        <CardListItem :card="element"/>
                                    </template>
                                </Draggable>

                            </div>
                               
                            </div>
    </div>
</template>