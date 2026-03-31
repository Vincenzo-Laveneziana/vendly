<template>
  <Menu as="div" class="relative w-full">
    <MenuButton class="w-full inline-flex justify-center gap-x-1.5 rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-blue-700 dark:bg-blue-600 dark:text-white dark:shadow-none dark:hover:bg-blue-700">
      Filtra per Categoria
      <ChevronDownIcon class="-mr-1 size-5 text-white" aria-hidden="true" />
    </MenuButton>

    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform scale-100" leave-to-class="transform opacity-0 scale-95">
      <MenuItems class="absolute left-0 right-0 z-10 mt-2 origin-top-left rounded-md bg-white shadow-lg outline-1 outline-black/5 dark:bg-gray-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <a href="/esplora" :class="[active ? 'bg-gray-100 text-gray-900 outline-hidden dark:bg-white/5 dark:text-white' : 'text-gray-700 dark:text-gray-300', 'block px-4 py-2 text-sm font-semibold']">Tutte le Categorie</a>
          </MenuItem>
          <div class="border-t border-gray-200 dark:border-gray-700"></div>
          <MenuItem v-for="(name, id) in categories" :key="id" v-slot="{ active }">
            <a :href="`/esplora?category=${id}`" :class="[active ? 'bg-gray-100 text-gray-900 outline-hidden dark:bg-white/5 dark:text-white' : 'text-gray-700 dark:text-gray-300', 'block px-4 py-2 text-sm']">{{ name }}</a>
          </MenuItem>
        </div>
      </MenuItems>
    </transition>
  </Menu>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'

defineProps({
  categories: {
    type: Object,
    default: () => ({})
  }
})
</script>