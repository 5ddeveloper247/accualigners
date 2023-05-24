@php
    //Paginator
    $paginator = $getTableData;
    $lastPage = $paginator->lastPage();
    $currentPage = $paginator->currentPage();
    $minPage = max($currentPage - 2, 1); // there are no pages < 1
    $maxPage = min($currentPage + 2, $lastPage); // and no pages > total_pages
    //Paginator End
@endphp

@if ($lastPage > 1)

    <div class="row float-right aeshazTablePagination">
        <div class="col-md-12">
            <ul class="pagination">

                <li class="paginate_button page-item {{ ($currentPage == 1) ? ' disabled' : '' }} ">
                    <a href="{{ $paginator->url(1).$filterUrlVariable }}" class="page-link">First</a>
                </li>

                <li class="paginate_button page-item {{ ($currentPage == 1) ? ' disabled' : '' }} ">
                    <a href="{{ $paginator->url($currentPage > 1 ? $currentPage-1 : 1).$filterUrlVariable }}" class="page-link">Previous</a>
                </li>

                @for($i = $minPage; $i <= $maxPage; ++$i)

                    <li class="paginate_button page-item {{ ($currentPage == $i) ? ' active' : '' }} ">
                        <a href="{{ $paginator->url($i).$filterUrlVariable }}" class="page-link">{{ $i }}</a>
                    </li>

                @endfor

                <li class="paginate_button page-item {{ ($currentPage == $lastPage) ? ' disabled' : '' }} ">
                    <a href="{{ $paginator->url($currentPage+1).$filterUrlVariable }}" class="page-link">Next</a>
                </li>

                <li class="paginate_button page-item {{ ($currentPage == $lastPage) ? 'disabled' : '' }} ">
                    <a href="{{ $paginator->url($lastPage).$filterUrlVariable }}" class="page-link">Last</a>
                </li>

            </ul>
        </div>
    </div>
@endif
