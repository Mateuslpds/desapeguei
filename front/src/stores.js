import { writable } from 'svelte/store';

export const isLogged = writable(false);
export const search = writable("");

export let users = writable([])
export let userid = writable([])
export let objs = writable([])