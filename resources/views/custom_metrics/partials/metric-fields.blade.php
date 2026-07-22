<div class="space-y-6">
            <div>
              <x-input-label for="name" value="Metric Name" class="block mb-1"/>
              <x-text-input 
                   type="text"
                   name="name"
                   id="name"
                   value="{{old('name')}}"
                   class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                />
              <x-input-error :messages="$errors->get('name')" class="mt-1" />
                                 

            </div>

             <div>

            <x-input-label for="description" value="Metric Description (optional)" class="block mb-1"/>
              <textarea
                   id="description"
                   name="description"
                   rows=4
                   class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded text-gray-100 p-2"          
              >{{ old('description') }}</textarea>          
              <x-input-error :messages="$errors->get('description')" class="mt-1" />

            </div>

</div>