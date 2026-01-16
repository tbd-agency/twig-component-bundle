<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD\Table;

use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'TBD:Table:SortableHeader',
    template: '@TbdTwigComponent/components/TBD/Table/SortableHeader.html.twig')]
final class SortableHeader
{
    public string $label;
    public string $sort;
    public SlidingPagination $pagination;
}
