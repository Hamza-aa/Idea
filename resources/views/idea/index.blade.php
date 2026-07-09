<x-layout>
    <div >
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan</p>

            <x-card
                x-data
                @click="$dispatch('open-modal', 'create-idea')"
                is="button"
                type="button"
                data-test="create-idea-button"
                class="mt-10 cursor-pointer h-20 w-full text-center"
            >
                <p>Have a new Idea? Add it here....</p>
            </x-card>
        </header>
        <div>
            <a href="/ideas" class="btn {{request()->has('status')? 'btn-outlined' : ''}}"> All</a>
        @foreach(\App\Models\IdeaStatus::cases() as $status)
                <a href="/ideas?status={{$status->value}}" class="btn {{request('status')===$status->value ? '' : 'btn-outlined'}}">
                    {{$status->label()}}
                    <span class="text-xs pl-3"> {{$statusCounts->get($status->value)}}</span>
                </a>
            @endforeach
        </div>

        <div class="mt-10 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse($ideas as $idea)
                    <x-card href="{{route('idea.show', $idea)}}">
                        <h3 class="text-foreground text-lg">{{$idea->title}}</h3>
                        <div class="mt-1">
                            <x-idea.status_label status="{{$idea->status->name}}">
                                {{$idea->status->label()}}
                            </x-idea.status_label>
                        </div>
                        <div class="mt-5 line-clamp-3 "> {{$idea->description}}</div>
                        <div class="mt-4">{{$idea->created_at->diffForHumans()}}</div>
                    </x-card>
                @empty
                    <x-card>
                        <p> No Ideas Yet</p>
                    </x-card>
                @endforelse
            </div>
        </div>

      <x-modal name="create-idea" title="New Idea">
          <form x-data="{status: 'pending',
                         newLink: '',
                         links: [],
                         newStep: '',
                         steps: [],
                         }"
                method="POST" action="{{ route('idea.store') }}">
              @csrf
              <div class="space-y-4">
                  <x-form.field
                      label="Title"
                      name="title"
                      type="text"
                      autofocus
                      placeholder="Enter an idea for the title"
                      required

                  />

                  <div class="space-y-2">
                      <label for="status" class="label">Status</label>

                      <div class="flex gap-x-3 mt-2">
                          @foreach(\App\Models\IdeaStatus::cases() as $status)
                              <button
                                  type="button"
                                  @click="status = @js($status->value)"
                                  data-test="button-status-{{ $status->value }}"
                                  class="btn flex-1 h-10 "
                                  :class="status === @js($status->value) ? '' : 'btn-outlined'"
                              >
                                  {{ $status->label() }}
                              </button>

                          @endforeach
                              <input type="hidden" name="status" :value="status" class="input">
                      </div>
                      <x-form.error name="status" />
                  </div>

                  <x-form.field
                      label="Description"
                      name="description"
                      type="textarea"
                      placeholder="Describe your idea"
                  />

                  <div>
                      <fieldset class="space-y-3">
                          <legend class="label">Steps</legend>

                          <template x-for="(step, index) in steps" :key="step">
                              <div class="flex gap-x-2 items-center">
                                  <input type="text" name="steps[]" x-model="step" class="input" readonly>

                                  <button
                                      type="button"
                                      class="text-xl font-bold text-red-500 rotate-45"
                                      @click="links.splice(index, 1) ;"
                                      aria-label="Remove a Link"
                                  >
                                      +
                                  </button>
                              </div>
                          </template>

                          <div class="flex gap-x-2 items-center">
                              <input
                                  x-model="newStep"
                                  type="text"
                                  id="new-step"
                                  data-test="new-step"
                                  placeholder="What needs to be done?"
                                  class="input flex-1"
                                  spellcheck="false"
                              >
                              <button
                                  type="button"
                                  class="text-xl font-bold text-green-500 "
                                  data-test="add-step"
                                  @click="steps.push(newStep.trim()); newStep = '' ;"
                                  :disabled="newStep.trim().length === 0"
                                  aria-label="Add a new Step"
                              >
                                  +
                              </button>
                          </div>

                      </fieldset>
                  </div>

                  <div>
                      <fieldset class="space-y-3">
                          <legend class="label">Links</legend>

                          <template x-for="(link, index) in links" :key="link">
                              <div class="flex gap-x-2 items-center">
                                  <input type="text" name="links[]" x-model="link" class="input">

                                  <button
                                      type="button"
                                      class="text-xl font-bold text-red-500 rotate-45"
                                      @click="links.splice(index, 1) ;"
                                      aria-label="Remove a Link"
                                  >
                                      +
                                  </button>
                              </div>
                          </template>

                          <div class="flex gap-x-2 items-center">
                              <input
                                  x-model="newLink"
                                  type="url"
                                  id="new-link"
                                  data-test="new-link"
                                  placeholder="https://example.com"
                                  autocomplete="url"
                                  class="input flex-1"
                                  spellcheck="false"
                              >
                              <button
                                  type="button"
                                  class="text-xl font-bold text-green-500 "
                                  data-test="add-link"
                                  @click="links.push(newLink.trim()); newLink = '' ;"
                                  :disabled="newLink.trim().length === 0"
                                  aria-label="Add a new Link"
                                  >
                                  +
                              </button>
                          </div>

                      </fieldset>
                  </div>

                  <div class="flex justify-end gap-x-5 mt-2">
                      <button type="button" @click="$dispatch('close-modal')">Cancel</button>
                      <button type="submit" class="btn">Create</button>
                  </div>
              </div>



          </form>
      </x-modal>


    </div>
</x-layout>
