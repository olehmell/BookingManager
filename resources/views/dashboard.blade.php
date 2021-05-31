<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 bg-white border-b border-gray-200">--}}
{{--                    You're logged in!--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <main class="max-w-7xl mx-auto pb-10 lg:py-12 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
{{--            <aside class="py-6 px-2 sm:px-6 lg:py-0 lg:px-0 lg:col-span-3">--}}
{{--                <nav class="space-y-1">--}}
{{--                    <a href="#" class="text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">--}}
{{--                        <!-- Heroicon name: user-circle -->--}}
{{--                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />--}}
{{--                        </svg>--}}
{{--                        <span class="truncate">--}}
{{--            Profile--}}
{{--          </span>--}}
{{--                    </a>--}}

{{--                    <a href="#" class="text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">--}}
{{--                        <!-- Heroicon name: cog -->--}}
{{--                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />--}}
{{--                        </svg>--}}
{{--                        <span class="truncate">--}}
{{--            Account--}}
{{--          </span>--}}
{{--                    </a>--}}

{{--                    <a href="#" class="text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">--}}
{{--                        <!-- Heroicon name: key -->--}}
{{--                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />--}}
{{--                        </svg>--}}
{{--                        <span class="truncate">--}}
{{--            Password--}}
{{--          </span>--}}
{{--                    </a>--}}

{{--                    <a href="#" class="text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">--}}
{{--                        <!-- Heroicon name: bell -->--}}
{{--                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />--}}
{{--                        </svg>--}}
{{--                        <span class="truncate">--}}
{{--            Notifications--}}
{{--          </span>--}}
{{--                    </a>--}}

{{--                    <!-- Current: "bg-gray-50 text-orange-600 hover:bg-white", Default: "text-gray-900 hover:text-gray-900 hover:bg-gray-50" -->--}}
{{--                    <a href="#" class="bg-gray-50 text-orange-600 hover:bg-white group rounded-md px-3 py-2 flex items-center text-sm font-medium" aria-current="page">--}}
{{--                        <!-- Current: "text-orange-500", Default: "text-gray-400 group-hover:text-gray-500" -->--}}
{{--                        <!-- Heroicon name: credit-card -->--}}
{{--                        <svg class="text-orange-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />--}}
{{--                        </svg>--}}
{{--                        <span class="truncate">--}}
{{--            Plan &amp; Billing--}}
{{--          </span>--}}
{{--                    </a>--}}

{{--                    <a href="#" class="text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">--}}
{{--                        <!-- Heroicon name: view-grid-add -->--}}
{{--                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />--}}
{{--                        </svg>--}}
{{--                        <span class="truncate">--}}
{{--            Integrations--}}
{{--          </span>--}}
{{--                    </a>--}}
{{--                </nav>--}}
{{--            </aside>--}}
<x-sidebar></x-sidebar>
            <!-- Payment details -->
            <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
                <section aria-labelledby="payment_details_heading">
                  <x-form-card action="/" method="POST">
                      <x-slot name="title">This is a test</x-slot>
                      <x-slot name="description">This is a description</x-slot>

                      <x-slot name="button">
                          <x-save-button>Save</x-save-button>
                      </x-slot>


                  </x-form-card>
                </section>

                <!-- Plan -->
                <section aria-labelledby="plan_heading">
                    <form action="#" method="POST">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                                <div>
                                    <h2 id="plan_heading" class="text-lg leading-6 font-medium text-gray-900">Plan</h2>
                                </div>

                                <fieldset>
                                    <legend class="sr-only">
                                        Pricing plans
                                    </legend>
                                    <ul class="relative bg-white rounded-md -space-y-px">
                                        <li>
                                            <!-- On: "bg-orange-50 border-orange-200 z-10", Off: "border-gray-200" -->
                                            <div class="relative border rounded-tl-md rounded-tr-md p-4 flex flex-col md:pl-4 md:pr-6 md:grid md:grid-cols-3">
                                                <label class="flex items-center text-sm cursor-pointer">
                                                    <input name="pricing_plan" type="radio" class="h-4 w-4 text-orange-500 cursor-pointer focus:ring-gray-900 border-gray-300" aria-describedby="plan-option-pricing-0 plan-option-limit-0">
                                                    <span class="ml-3 font-medium text-gray-900">Startup</span>
                                                </label>
                                                <p id="plan-option-pricing-0" class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-center">
                                                    <!-- On: "text-orange-900", Off: "text-gray-900" -->
                                                    <span class="font-medium">$29 / mo</span>
                                                    <!-- On: "text-orange-700", Off: "text-gray-500" -->
                                                    <span>($290 / yr)</span>
                                                </p>
                                                <!-- On: "text-orange-700", Off: "text-gray-500" -->
                                                <p id="plan-option-limit-0" class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-right">Up to 5 active job postings</p>
                                            </div>
                                        </li>

                                        <li>
                                            <!-- On: "bg-orange-50 border-orange-200 z-10", Off: "border-gray-200" -->
                                            <div class="relative border border-gray-200 p-4 flex flex-col md:pl-4 md:pr-6 md:grid md:grid-cols-3">
                                                <label class="flex items-center text-sm cursor-pointer">
                                                    <input name="pricing_plan" type="radio" class="h-4 w-4 text-orange-500 cursor-pointer focus:ring-gray-900 border-gray-300" aria-describedby="plan-option-pricing-1 plan-option-limit-1" checked>
                                                    <span class="ml-3 font-medium text-gray-900">Business</span>
                                                </label>
                                                <p id="plan-option-pricing-1" class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-center">
                                                    <!-- On: "text-orange-900", Off: "text-gray-900" -->
                                                    <span class="font-medium">$99 / mo</span>
                                                    <!-- On: "text-orange-700", Off: "text-gray-500" -->
                                                    <span>($990 / yr)</span>
                                                </p>
                                                <!-- On: "text-orange-700", Off: "text-gray-500" -->
                                                <p id="plan-option-limit-1" class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-right">Up to 25 active job postings</p>
                                            </div>
                                        </li>

                                        <li>
                                            <!-- On: "bg-orange-50 border-orange-200 z-10", Off: "border-gray-200" -->
                                            <div class="relative border border-gray-200 rounded-bl-md rounded-br-md p-4 flex flex-col md:pl-4 md:pr-6 md:grid md:grid-cols-3">
                                                <label class="flex items-center text-sm cursor-pointer">
                                                    <input name="pricing_plan" type="radio" class="h-4 w-4 text-orange-500 cursor-pointer focus:ring-gray-900 border-gray-300" aria-describedby="plan-option-pricing-2 plan-option-limit-2">
                                                    <span class="ml-3 font-medium text-gray-900">Enterprise</span>
                                                </label>
                                                <p id="plan-option-pricing-2" class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-center">
                                                    <!-- On: "text-orange-900", Off: "text-gray-900" -->
                                                    <span class="font-medium">$249 / mo</span>
                                                    <!-- On: "text-orange-700", Off: "text-gray-500" -->
                                                    <span>($2490 / yr)</span>
                                                </p>
                                                <!-- On: "text-orange-700", Off: "text-gray-500" -->
                                                <p id="plan-option-limit-2" class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-right">Unlimited active job postings</p>
                                            </div>
                                        </li>
                                    </ul>
                                </fieldset>

                                <div class="flex items-center">
                                    <!-- On: "bg-orange-500", Off: "bg-gray-200" -->
                                    <button type="button" aria-pressed="true" aria-labelledby="toggleLabel" class="bg-gray-200 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors ease-in-out duration-200">
                                        <span class="sr-only">Use setting</span>
                                        <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                        <span aria-hidden="true" class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                    </button>
                                    <span id="toggleLabel" class="ml-3">
                  <span class="text-sm font-medium text-gray-900">Annual billing </span>
                  <span class="text-sm text-gray-500">(Save 10%)</span>
                </span>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="bg-gray-800 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </section>

                <!-- Billing history -->
                <section aria-labelledby="billing_history_heading">
                    <div class="bg-white pt-6 shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 sm:px-6">
                            <h2 id="billing_history_heading" class="text-lg leading-6 font-medium text-gray-900">Billing history</h2>
                        </div>
                        <div class="mt-6 flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="overflow-hidden border-t border-gray-200">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Date
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Description
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Amount
                                                </th>
                                                <!--
                                                  `relative` is added here due to a weird bug in Safari that causes `sr-only` headings to introduce overflow on the body on mobile.
                                                -->
                                                <th scope="col" class="relative px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <span class="sr-only">View receipt</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    1/1/2020
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    Business Plan - Annual Billing
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    CA$109.00
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#" class="text-orange-600 hover:text-orange-900">View receipt</a>
                                                </td>
                                            </tr>

                                            <!-- More items... -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</x-app-layout>
