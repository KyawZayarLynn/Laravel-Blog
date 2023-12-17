<x-layout>
    <x-hero/>

    <x-blogs-section
        :blogs="$blogs" 
        :currentCategory="$currentCategory ?? null"
    />

    <x-subscribe/>

</x-layout>