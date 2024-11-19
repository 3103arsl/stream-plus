<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

class Deserializer
{
    private SerializerInterface $serializer;
    private NormalizerInterface $normalizer;

    public function __construct(
        SerializerInterface $serializer,
        NormalizerInterface $normalizer
    )
    {
        $this->serializer = $serializer;
        $this->normalizer = $normalizer;
    }

    /**
     * @param Request $request
     * @param string $dtoClass
     * @return object|mixed|null
     */
    public function deserializeJson(Request $request, string $dtoClass): ?object
    {
        $data = $request->getContent();
        return $this->serializer->deserialize($data, $dtoClass, 'json');
    }

    /**
     * @param User $user
     * @param array $groups
     * @return object|string|null
     */
    public function serialize(User $user, array $groups = ['api'])
    {
        return $this->serializer->serialize($user, 'json', ['groups' => $groups]);
    }

    /**
     * @param $data
     * @param array $context
     * @return array
     */
    public function serializeToArray($data, array $context = []): array
    {
        return $this->normalizer->normalize($data, null, $context);
    }
}
