<div class="o-grid modularity-guide-todos js-modularity-guide-todos">
    <div class="o-grid-12">
        <table class="table mod-guide-todo-list js-modularity-guide-todos__table">
            <thead>
                <tr>
                    <th>{{_e('Title', 'modularity-guides')}}</th>
                    <th>{{_e('Link', 'modularity-guides')}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($content['list_items'] as $item)
                <tr {!! isset($item['toggle_key']) && !empty($item['toggle_key']) ? 'data-mod-guide-toggle-key-content="' . $item['toggle_key'] . '"' : '' !!}>
                    <td>{{ $item['title'] }}</td>
                    <td>
                        @if (isset($item['link_url']) && !empty($item['link_url']))
                        <a href="{{ $item['link_url'] }}" class="link-item">{{ isset($item['link_text']) && !empty($item['link_text']) ? $item['link_text'] : 'Mer information' }}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot class="hidden-print">
                <tr>
                    <th colspan="3">
                        @button( [
                            'href' => '',
                            'icon' => 'mail',
                            'color' => 'primary',
                            'style' => 'filled',
                            'reversePositions' => true,
                            'size' => 'sm',
                            'text' => __('Send as email', 'modularity-guides'),
                            'attributeList' => [
                                'data-open' => "mod-guide-todo-".$stepId
                            ]
                        ])
                        @endbutton
                    </th>
                </tr>
            </tfoot>
        </table>

        @modal([
            'heading' => __('Send todo-list as email', 'modularity-guides'),
            'isPanel' => false,
            'id' => "mod-guide-todo-".$stepId,
            'overlay' => 'dark',
            'animation' => 'scale-up',
            'size' => 'sm',
            'classList' => ['js-modularity-guide-todos__modal'],
            'attributeList' => [
                'tabindex' => "-1",
                'role' => "dialog",
                'aria-hidden' => "true"
            ]
        ])
            @form([
                'method' => 'POST',
                'classList' => ['js-modularity-guide-todos__form']
            ])
                <div class="o-grid o-grid--no-margin">
                    <div class="o-grid-12 u-margin__bottom--3">
                        @field([
                            'type' => 'text',
                            'id' => 'send-todo-email',
                            'attributeList' => [
                                'type' => 'email',
                                'name' => 'email',
                                'pattern' => '^[^@]+@[^@]+\.[^@]+$',
                                'autocomplete' => 'e-mail',
                                'data-invalid-message' => "You need to add a valid E-mail!"
                            ],
                            'label' => __('Email', 'modularity-guides'),
                            'required' => true,
                        ])
                        @endfield

                    </div>

                    @if(!is_user_logged_in() && $municipio && $g_recaptcha_key)
                        <div class="o-grid-12 u-margin__bottom--3">
                            <div class="js-modularity-guide-todos__grecaptcha" data-sitekey="{{ $g_recaptcha_key }}"></div>
                        </div>
                    @endif
                
                    <div class="o-grid-12">
                        <div class="o-grid o-grid--no-margin">
                            <div class="o-grid-fit">
                                @button([
                                    'text' => __('Send', 'modularity-guides'),
                                    'color' => 'primary',
                                    'style' => 'filled',
                                    'type' => 'submit'
                                ])
                                @endbutton
                            </div>
                            <div class="o-grid-fit">
                                @loader([
                                    'size' => 'sm',
                                    'classList' => []
                                ])
                                @endloader
                            </div>
                        </div>
                    </div>
                </div>



            @endform
            
            @slot('bottom')
                @notice([
                    'type' => 'success',
                    'message' => [
                        'text' => 'Tellus Sem Lorem Malesuada Ipsum',
                        'size' => 'sm'
                    ],
                    'classList' => ['js-modularity-guide-todos__notice', 'u-display--none'],
                    'icon' => [
                        'name' => 'check',
                        'size' => 'md',
                        'color' => 'white'
                    ]
                ])
                @endnotice
            @endslot

        @endmodal

    </div>
</div>

