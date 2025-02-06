<div>

                    @if ($errors->any())
                    <div class="alert alert-danger alert-spacing font-15 m-l-22 m-r-22">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session()->has('success'))
                        @if (session()->get('success')->status)
                        <div class="row clearfix">
                            <div class="col s12">
                                    <div class="alert alert-success alert-spacing font-15 m-l-22 m-r-22" >
                                        {!!   session()->get('success')->msg !!}
                                    </div>

                            </div>
                        </div>
                        @endif
                    @endif
                        @if (!is_null($msg))
                            <div
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 5000)"
                                    class="alert alert-success p-10 m-t-5 animate__animated animate__shakeX" role="alert">
                                <span class="font-14">{{ $msg }}</span>
                            </div>
                        @endif
                        @if (session('msg'))
                            <div
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 5000)"
                                    class="alert alert-success p-10 m-t-5 animate__animated animate__shakeX" role="alert">
                                <span>{{ __(session('msg')) }}</span>
                            </div>
                        @endif


</div>