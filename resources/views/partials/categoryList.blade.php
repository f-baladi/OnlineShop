<div class="nav container-fluid">
    <ul class="shop_menu_ul d-flex flex-row">
        <li class="shop_nav_li" id="show_cat_list">
            <span class="fa fa-bars"></span>
            <span>دسته بندی ها</span>
            <div class="cat-list-div" >

                <div class="cat-list-box">

                    <div class="parent-list">
                        <ul class="list-inline cat_list">
                            @foreach($categories as $key=>$value)
                                <li data-index = "{{$key}}">
                                    <a  href="">{{ $value->title }}</a>
                                </li>

                            @endforeach
                        </ul>
                    </div>

                    <div class="child-list">
                        @foreach($categories as $key=>$value)
                            <div @if($key == 0) style="display: block" @endif class="child-list-div category-list-{{$key}}">
                                @if(sizeof($value->getChild)>0)
                                    <?php
                                    $c=0;
                                    ?>
                                    @if(sizeof($value->getChild)>0) @if($c==0) <ul class="list-inline subList"> @endif @endif
                                        @foreach($value->getChild as $key2=>$value2)

                                            @if(sizeof($value2->getChild)>=(7-$c)) <?php $c=0 ?>  </ul> <ul class="list-inline subList"> @endif
                                        <li>
                                            <a class="child_cat" href="">
                                                <span class="fa fa-angle-left"></span>
                                                <span>{{ $value2->title }}</span>
                                            </a>
                                            <ul>
                                                @foreach($value2->getChild as $key3=>$value3)
                                                    <li>
                                                        <a href="">{{ $value3->title }}</a>
                                                    </li>
                                                    <?php $c++; ?>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <?php $c++ ?>
                                        @if($c==7)  </ul> <?php $c=0; ?> <ul class="list-inline subList"> @endif

                                        @endforeach

                                        @if($c!=0) </ul> @endif
                                    @endif
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </li>
        <li>
            <a href="">
                <span class="fa fa-gift"></span>
                <span>تخفیف و پیشنهادها</span>
            </a>
        </li>

        <li>
            <a href="">
                <span>سوالی دارید؟</span>
            </a>
        </li>

        <li>
            <a href="">
                <span>فروشنده شوید</span>
            </a>
        </li>
    </ul>
</div>
