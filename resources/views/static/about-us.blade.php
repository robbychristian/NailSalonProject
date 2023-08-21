@extends('layouts.app')
@section('title', '| About Us')

@section('content')
    <section id="about-us" class="bg-pink">
        <div class="container mx-auto md:px-20 px-4">
            <h1
                class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl uppercase text-center mb-10">
                Who we are. What we do.
            </h1>

            <div class="grid grid-cols-2 justify-items-center items-center">
                <div class="h-96 w-full">
                    <img class="h-full w-full object-cover" src="{{ asset('img/homepage/graceyfront.jpg') }}" alt="">
                </div>
                <div class="h-96 w-full">
                    <img class="h-full w-full object-cover" src="{{ asset('img/homepage/graceyindo.jpg') }}" alt="">
                </div>
            </div>

            <div class="bg-dark-pink mt-6">
                <p class="text-justify p-5"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus quas
                    dignissimos beatae laboriosam deleniti maiores nobis fugiat facere, nostrum tempora omnis debitis? Nihil
                    ut temporibus nobis nulla vitae nam consequatur. Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit. Totam in, neque est minima pariatur dignissimos fugiat id minus odio voluptatibus accusantium
                    error temporibus hic illo porro beatae magnam iste tempora! Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Cum reprehenderit dolores ab ad consequuntur, enim corporis, autem sapiente molestias
                    nesciunt ducimus neque exercitationem, vero nulla est. Velit molestiae laborum enim? Lorem ipsum dolor
                    sit amet consectetur adipisicing elit. Repudiandae non inventore mollitia laudantium ipsum autem odio
                    vitae possimus odit omnis ducimus praesentium reprehenderit distinctio officiis, maxime facere
                    assumenda? Natus, illum?
                </p>

                <p class="text-justify p-5"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus quas
                    dignissimos beatae laboriosam deleniti maiores nobis fugiat facere, nostrum tempora omnis debitis? Nihil
                    ut temporibus nobis nulla vitae nam consequatur. Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit. Totam in, neque est minima pariatur dignissimos fugiat id minus odio voluptatibus accusantium
                    error temporibus hic illo porro beatae magnam iste tempora! Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Cum reprehenderit dolores ab ad consequuntur, enim corporis, autem sapiente molestias
                    nesciunt ducimus neque exercitationem, vero nulla est. Velit molestiae laborum enim? Lorem ipsum dolor
                    sit amet consectetur adipisicing elit. Repudiandae non inventore mollitia laudantium ipsum autem odio
                    vitae possimus odit omnis ducimus praesentium reprehenderit distinctio officiis, maxime facere
                    assumenda? Natus, illum?
                </p>
            </div>

            <h1
                class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl uppercase mt-10">
                Our Team
            </h1>

            <div class="mt-6 grid grid-cols-12 justify-items-center items-center gap-10">
                <div class="col-span-12 md:col-span-3 bg-darker-pink h-full w-full">
                    <div class="h-full flex justify-center items-center">
                        <img class="h-64 w-64 rounded-full" src="{{ asset('img/homepage/founder.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-span-12 md:col-span-9 h-full w-full">
                    <div class="grid grid-rows-12 gap-5">
                        <div class="rows-span-12 md:rows-span-3 bg-dark-pink">
                            <h3 class="text-center p-3 text-3xl font-bold uppercase">Founder, Gladys Depollo</h3>
                        </div>
                        <div class="rows-span-12 md:rows-span-9 bg-dark-pink">
                            <p class="p-5 text-justify"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam,
                                eaque excepturi officiis perspiciatis iste quae quod! Libero laudantium recusandae quis quo,
                                porro similique facilis! Aliquid repudiandae at totam odit qui. Lorem ipsum dolor sit amet
                                consectetur adipisicing elit. Fugiat porro perferendis sapiente tempore! Unde, quis! Quod
                                obcaecati vitae quos eos natus modi, sed excepturi fuga eligendi facere ratione cum iste?
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate ex quisquam rem sed
                                asperiores odio, facilis iure cumque illum quos ea optio itaque expedita atque inventore
                                nobis provident ipsam magni.
                            </p>
                            <p class="p-5 text-justify"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam,
                                eaque excepturi officiis perspiciatis iste quae quod! Libero laudantium recusandae quis quo,
                                porro similique facilis! Aliquid repudiandae at totam odit qui. Lorem ipsum dolor sit amet
                                consectetur adipisicing elit. Fugiat porro perferendis sapiente tempore! Unde, quis! Quod
                                obcaecati vitae quos eos natus modi, sed excepturi fuga eligendi facere ratione cum iste?
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate ex quisquam rem sed
                                asperiores odio, facilis iure cumque illum quos ea optio itaque expedita atque inventore
                                nobis provident ipsam magni.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-10 grid grid-cols-1 md:grid-cols-3 gap-10 justify-items-stretch mt-10">

                <div class="h-full">
                    <div class="h-full flex justify-center items-center bg-darker-pink">
                        <img class="h-40 w-40 rounded-full" src="{{ asset('img/homepage/founder.jpg') }}" alt="">
                    </div>

                    <p class="font-bold text-center">Marvie Japilla</p>
                </div>

                <div class="h-full">
                    <div class="h-full flex justify-center items-center bg-darker-pink">
                        <img class="h-40 w-40 rounded-full" src="{{ asset('img/homepage/founder.jpg') }}" alt="">
                    </div>

                    <p class="font-bold text-center">Marvie Japilla</p>
                </div>

                <div class="h-full">
                    <div class="h-full flex justify-center items-center bg-darker-pink">
                        <img class="h-40 w-40 rounded-full" src="{{ asset('img/homepage/founder.jpg') }}" alt="">
                    </div>

                    <p class="font-bold text-center">Marvie Japilla</p>
                </div>

                <div class="h-full">
                    <div class="h-full flex justify-center items-center bg-darker-pink">
                        <img class="h-40 w-40 rounded-full" src="{{ asset('img/homepage/founder.jpg') }}" alt="">
                    </div>

                    <p class="font-bold text-center">Marvie Japilla</p>
                </div>

                <div class="h-full">
                    <div class="h-full flex justify-center items-center bg-darker-pink">
                        <img class="h-40 w-40 rounded-full" src="{{ asset('img/homepage/founder.jpg') }}" alt="">
                    </div>

                    <p class="font-bold text-center">Marvie Japilla</p>
                </div>
            </div>
        </div>
    </section>
@endsection
