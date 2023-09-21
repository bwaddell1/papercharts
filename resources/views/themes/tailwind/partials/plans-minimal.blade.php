<div class="flex flex-wrap w-full mx-auto divide-x divide-gray-100 divide-solid my-12">
    @foreach(Spark\Spark::plans('team') as $plan)
        @php $features =$plan->features; @endphp

        <div class="w-full max-w-md px-0 mx-auto mb-6 lg:w-1/3 lg:mb-0">
            <div class="relative flex flex-col h-full mb-10 bg-white shadow rounded-lg sm:mb-0">
                <div class="px-10 pt-7">
                    <div class="absolute right-0 inline-block mr-6 transform">
                        <h2 class="relative z-20 w-full h-full px-2 py-1 text-xs font-bold leading-tight tracking-wide text-center uppercase bg-white border-2 
                        border-wave-400 text-wave-500
                        rounded">{{ $plan->name }}</h2>

                    </div>
                </div>
                <div class="px-10 mt-5">
                    <span class="font-mono text-5xl font-bold">${{ 20 }}</span>
                    <span class="text-lg font-bold text-gray-500"> per month</span>
                    <span class="text-lg font-bold text-gray-500"> / per provider</span>
                </div>

                <div class="px-10 mt-6 pb-9">
                    <p class="text-lg leading-7 text-gray-500">{{ $plan->shortDescription }}</p>
                </div>

                <div class="relative px-10 pt-0 pb-12 mt-auto text-gray-700">

                    <ul class="flex flex-col space-y-2.5">
                        @foreach($features as $feature)
                            <li class="relative">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-3 text-green-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"></path>
                                    </svg>

                                    <span>
                                        {{ $feature }}
                                    </span>
                                </span>
                            </li>
                        @endforeach
                    </ul>


                </div>
                <div class="relative">
                    @if(auth()->user()->currentTeam->subscribedPlan($plan->id))
                        <div class="rounded-b-lg border-gray-700 border inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold transition duration-150 ease-in-out bg-gray-200 border border-transparent cursor-default text-wave-600 focus:outline-none disabled:opacity-25" disabled>
                            You're subscribed to this plan
                        </div>
                    @else
                        @if(auth()->user()->currentTeam->sparkPlan())
                            <a href="/billing" class="rounded-b-lg border-gray-700 border inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold text-white transition duration-150 ease-in-out bg-gradient-to-r from-wave-600 to-indigo-500 hover:from-wave-500 hover:to-indigo-400 border border-transparent cursor-pointer focus:outline-none disabled:opacity-25">
                                Switch Plans
                            </a>
                        @else
                            <a href="/billing" class="rounded-b-lg border-gray-700 border inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold text-white transition duration-150 ease-in-out bg-gradient-to-r from-wave-600 to-indigo-500 hover:from-wave-500 hover:to-indigo-400 border border-transparent cursor-pointer checkout focus:outline-none disabled:opacity-25">
                                Get Started
                            </a>
                        @endif
                    @endif
                </div>

            </div>
        </div>

    @endforeach
</div>