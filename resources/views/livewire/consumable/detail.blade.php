<div>
    <!-- Payment details -->
    <div class="space-y-6 sm:px-6 lg:col-span-9 lg:px-0">
        <section aria-labelledby="payment-details-heading">
            <form action="#" method="POST">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="bg-white py-6 px-4 sm:p-6">
                        <div>
                            <h2 id="payment-details-heading" class="text-lg font-medium leading-6 text-gray-900">Payment
                                details</h2>
                            <p class="mt-1 text-sm text-gray-500">Update your billing information. Please note that
                                updating your location could affect your tax rates.</p>
                        </div>

                        <div class="mt-6 grid grid-cols-4 gap-6">
                            <div class="col-span-4 sm:col-span-2">
                                <label for="first-name" class="block text-sm font-medium text-gray-700">First
                                    name</label>
                                <input type="text" name="first-name" id="first-name" autocomplete="cc-given-name"
                                    class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-gray-900 sm:text-sm" />
                            </div>

                            <div class="col-span-4 sm:col-span-2">
                                <label for="last-name" class="block text-sm font-medium text-gray-700">Last name</label>
                                <input type="text" name="last-name" id="last-name" autocomplete="cc-family-name"
                                    class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-gray-900 sm:text-sm" />
                            </div>

                            <div class="col-span-4 sm:col-span-2">
                                <label for="email-address" class="block text-sm font-medium text-gray-700">Email
                                    address</label>
                                <input type="text" name="email-address" id="email-address" autocomplete="email"
                                    class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-gray-900 sm:text-sm" />
                            </div>

                            <div class="col-span-4 sm:col-span-1">
                                <label for="expiration-date" class="block text-sm font-medium text-gray-700">Expration
                                    date</label>
                                <input type="text" name="expiration-date" id="expiration-date" autocomplete="cc-exp"
                                    class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-gray-900 sm:text-sm"
                                    placeholder="MM / YY" />
                            </div>

                            <div class="col-span-4 sm:col-span-1">
                                <label for="security-code" class="flex items-center text-sm font-medium text-gray-700">
                                    <span>Security code</span>
                                    <!-- Heroicon name: mini/question-mark-circle -->
                                    <svg class="ml-1 h-5 w-5 flex-shrink-0 text-gray-300"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM8.94 6.94a.75.75 0 11-1.061-1.061 3 3 0 112.871 5.026v.345a.75.75 0 01-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 108.94 6.94zM10 15a1 1 0 100-2 1 1 0 000 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </label>
                                <input type="text" name="security-code" id="security-code" autocomplete="cc-csc"
                                    class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-gray-900 sm:text-sm" />
                            </div>

                            <div class="col-span-4 sm:col-span-2">
                                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                <select id="country" name="country" autocomplete="country-name"
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-gray-900 sm:text-sm">
                                    <option>United States</option>
                                    <option>Canada</option>
                                    <option>Mexico</option>
                                </select>
                            </div>

                            <div class="col-span-4 sm:col-span-2">
                                <label for="postal-code" class="block text-sm font-medium text-gray-700">ZIP / Postal
                                    code</label>
                                <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code"
                                    class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-gray-900 sm:text-sm" />
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-gray-800 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">Save</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Plan -->
        <section aria-labelledby="plan-heading">
            <form action="#" method="POST">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white py-6 px-4 sm:p-6">
                        <div>
                            <h2 id="plan-heading" class="text-lg font-medium leading-6 text-gray-900">Plan</h2>
                        </div>

                        <fieldset>
                            <legend class="sr-only">Pricing plans</legend>
                            <div class="relative -space-y-px rounded-md bg-white">
                                <!-- Checked: "bg-orange-50 border-orange-200 z-10", Not Checked: "border-gray-200" -->
                                <label
                                    class="relative flex cursor-pointer flex-col rounded-tl-md rounded-tr-md border p-4 focus:outline-none md:grid md:grid-cols-3 md:pl-4 md:pr-6">
                                    <span class="flex items-center text-sm">
                                        <input type="radio" name="pricing-plan" value="Startup"
                                            class="h-4 w-4 border-gray-300 text-orange-500 focus:ring-gray-900"
                                            aria-labelledby="pricing-plans-0-label"
                                            aria-describedby="pricing-plans-0-description-0 pricing-plans-0-description-1" />
                                        <span id="pricing-plans-0-label"
                                            class="ml-3 font-medium text-gray-900">Startup</span>
                                    </span>
                                    <span id="pricing-plans-0-description-0"
                                        class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-center">
                                        <!-- Checked: "text-orange-900", Not Checked: "text-gray-900" -->
                                        <span class="font-medium">$29 / mo</span>
                                        <!-- Checked: "text-orange-700", Not Checked: "text-gray-500" -->
                                        <span>($290 / yr)</span>
                                    </span>
                                    <!-- Checked: "text-orange-700", Not Checked: "text-gray-500" -->
                                    <span id="pricing-plans-0-description-1"
                                        class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-right">Up to 5 active job
                                        postings</span>
                                </label>

                                <!-- Checked: "bg-orange-50 border-orange-200 z-10", Not Checked: "border-gray-200" -->
                                <label
                                    class="relative flex cursor-pointer flex-col border p-4 focus:outline-none md:grid md:grid-cols-3 md:pl-4 md:pr-6">
                                    <span class="flex items-center text-sm">
                                        <input type="radio" name="pricing-plan" value="Business"
                                            class="h-4 w-4 border-gray-300 text-orange-500 focus:ring-gray-900"
                                            aria-labelledby="pricing-plans-1-label"
                                            aria-describedby="pricing-plans-1-description-0 pricing-plans-1-description-1" />
                                        <span id="pricing-plans-1-label"
                                            class="ml-3 font-medium text-gray-900">Business</span>
                                    </span>
                                    <span id="pricing-plans-1-description-0"
                                        class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-center">
                                        <!-- Checked: "text-orange-900", Not Checked: "text-gray-900" -->
                                        <span class="font-medium">$99 / mo</span>
                                        <!-- Checked: "text-orange-700", Not Checked: "text-gray-500" -->
                                        <span>($990 / yr)</span>
                                    </span>
                                    <!-- Checked: "text-orange-700", Not Checked: "text-gray-500" -->
                                    <span id="pricing-plans-1-description-1"
                                        class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-right">Up to 25 active job
                                        postings</span>
                                </label>

                                <!-- Checked: "bg-orange-50 border-orange-200 z-10", Not Checked: "border-gray-200" -->
                                <label
                                    class="relative flex cursor-pointer flex-col rounded-bl-md rounded-br-md border p-4 focus:outline-none md:grid md:grid-cols-3 md:pl-4 md:pr-6">
                                    <span class="flex items-center text-sm">
                                        <input type="radio" name="pricing-plan" value="Enterprise"
                                            class="h-4 w-4 border-gray-300 text-orange-500 focus:ring-gray-900"
                                            aria-labelledby="pricing-plans-2-label"
                                            aria-describedby="pricing-plans-2-description-0 pricing-plans-2-description-1" />
                                        <span id="pricing-plans-2-label"
                                            class="ml-3 font-medium text-gray-900">Enterprise</span>
                                    </span>
                                    <span id="pricing-plans-2-description-0"
                                        class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-center">
                                        <!-- Checked: "text-orange-900", Not Checked: "text-gray-900" -->
                                        <span class="font-medium">$249 / mo</span>
                                        <!-- Checked: "text-orange-700", Not Checked: "text-gray-500" -->
                                        <span>($2490 / yr)</span>
                                    </span>
                                    <!-- Checked: "text-orange-700", Not Checked: "text-gray-500" -->
                                    <span id="pricing-plans-2-description-1"
                                        class="ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-right">Unlimited active job
                                        postings</span>
                                </label>
                            </div>
                        </fieldset>

                        <div class="flex items-center">
                            <!-- Enabled: "bg-orange-500", Not Enabled: "bg-gray-200" -->
                            <button type="button"
                                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-gray-200 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2"
                                role="switch" aria-checked="true" aria-labelledby="annual-billing-label">
                                <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
                                <span aria-hidden="true"
                                    class="inline-block h-5 w-5 translate-x-0 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                            <span class="ml-3" id="annual-billing-label">
                                <span class="text-sm font-medium text-gray-900">Annual billing</span>
                                <span class="text-sm text-gray-500">(Save 10%)</span>
                            </span>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-gray-800 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">Save</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Billing history -->
        <section aria-labelledby="billing-history-heading">
            <div class="bg-white pt-6 shadow sm:overflow-hidden sm:rounded-md">
                <div class="px-4 sm:px-6">
                    <h2 id="billing-history-heading" class="text-lg font-medium leading-6 text-gray-900">Billing
                        history</h2>
                </div>
                <div class="mt-6 flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <div class="overflow-hidden border-t border-gray-200">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Date
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-semibold text-gray-900">
                                                Description</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Amount
                                            </th>
                                            <!--
                            `relative` is added here due to a weird bug in Safari that causes `sr-only` headings to introduce overflow on the body on mobile.
                          -->
                                            <th scope="col"
                                                class="relative px-6 py-3 text-left text-sm font-medium text-gray-500">
                                                <span class="sr-only">View receipt</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                                <time datetime="2020-01-01">1/1/2020</time>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">Business Plan
                                                - Annual Billing</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">CA$109.00
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                                <a href="#" class="text-orange-600 hover:text-orange-900">View
                                                    receipt</a>
                                            </td>
                                        </tr>

                                        <!-- More payments... -->
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
