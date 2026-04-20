<?php

namespace Tbd\TwigComponentBundle\Twig\Components\TBD;

use Ramsey\Uuid\Uuid;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'TBD:SubTitle',
    template: '@TbdTwigComponent/components/TBD/SubTitle.html.twig')]
final class SubTitle
{
    public string $label;
    public string $tag;
    public string $wrapper;
    public ?string $tooltip = null;
    public ?string $tooltipId = null;

    public function __construct(
        private readonly array $fontSizes,
        private readonly string $defaultTag,
    ){
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setIgnoreUndefined()
            ->setRequired('label')
            ->setDefaults([
                'tag' => $this->defaultTag,
                'wrapper' => 'div'
            ])
            ->setAllowedValues('tag', array_keys($this->fontSizes))
            ->setAllowedValues('wrapper', ['div', 'span', 'a']);

        return $resolver->resolve($data) + $data;
    }

    public function mount(): void
    {
        if (empty($this->tooltipId)) $this->tooltipId = Uuid::uuid4()->toString();
    }

    public function getTextSizeClass(): string
    {
        return $this->fontSizes[$this->tag];
    }
}
