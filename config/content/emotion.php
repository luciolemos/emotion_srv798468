<?php

declare(strict_types=1);

return [
    'seo' => [
        'title' => 'Jersika Carvalho | Psicóloga para mulheres (CRP 17/1671)',
        'description' => 'Psicóloga dedicada ao universo feminino, com escuta sensível e prática voltada ao acolhimento, autoconhecimento e ressignificação de histórias.',
        'site_name' => 'Jersika Carvalho',
        'image' => [
            'src' => 'assets/img/social/psicologia-og-v4.jpg?v=20260520223235',
            'width' => 1200,
            'height' => 630,
            'alt' => 'Atendimento psicológico em ambiente reservado e acolhedor',
        ],
        'schema' => [
            'type' => 'MedicalBusiness',
            'logo' => 'assets/img/brand/jerssica-square-light.png',
            'logo_dark' => 'assets/img/brand/jerssica-square-dark.png',
            'logo_light' => 'assets/img/brand/jerssica-square-light.png',
            'area_served' => 'Bahia',
            'include_services' => true,
            'include_faq' => true,
        ],
    ],
    'nav' => [
        'badge' => 'Psicóloga',
        'cta' => 'Agendar',
    ],
    'typography' => [
        'profile' => 'clinical',
    ],
    'hero' => [
        'badge_icon' => 'journal-heart',
        'badge' => 'Psicóloga | CRP 17/1671',
        'title_parts' => [
            'Você não precisa',
            'carregar tudo',
            'sozinha.',
        ],
        'subtitle' => 'Muitas mulheres aprenderam a sustentar tudo ao redor, mas se perderam de si mesmas no caminho.',
        'lead' => 'A terapia pode ser um espaço para fortalecer sua autoestima, compreender suas emoções e reconstruir uma relação mais leve consigo mesma.',
        'primary_cta' => [
            'label' => 'Quero começar minha terapia',
            'href' => '#agendar',
            'icon' => 'arrow-right-short',
        ],
        'secondary_cta' => [
            'label' => 'Conhecer a abordagem',
            'href' => '#sobre-mim',
            'icon' => 'journal-text',
        ],
        'trust_items' => [
            ['icon' => 'shield-check', 'label' => 'Privacidade emocional'],
            ['icon' => 'calendar2-check', 'label' => 'Horário protegido'],
            ['icon' => 'chat-heart', 'label' => 'Escuta clínica'],
        ],
        'proof' => [
            'title' => 'Atendimento profissional com presença e continuidade',
            'lines' => [
                'Jersika Carvalho é uma profissional extremamente competente, sensível e acolhedora, dedicada ao cuidado e ao fortalecimento emocional de mulheres.',
                'Em cada sessão, uma escuta atenta, um acompanhamento cuidadoso em um espaço realmente seguro e acolhedor.',
            ],
        ],
        'image' => [
            'src' => 'assets/img/hero/terapia-casal/terapia-casal-desktop-640.webp',
            'sources' => [
                ['path' => 'assets/img/hero/terapia-casal/terapia-casal-desktop-640.webp', 'width' => 640],
                ['path' => 'assets/img/hero/terapia-casal/terapia-casal-desktop-960.webp', 'width' => 960],
                ['path' => 'assets/img/hero/terapia-casal/terapia-casal-desktop-1086.webp', 'width' => 1086],
            ],
            'mobile' => [
                'src' => 'assets/img/hero/terapia-casal/terapia-casal-mobile-640.webp',
                'sources' => [
                    ['path' => 'assets/img/hero/terapia-casal/terapia-casal-mobile-640.webp', 'width' => 640],
                ],
                'sizes' => '92vw',
                'media' => '(max-width: 576px)',
                'width' => 640,
                'height' => 512,
            ],
            'alt' => 'Casal em sessão terapêutica',
            'width' => 640,
            'height' => 512,
        ],
        'metrics' => [
            ['kpi' => 'CRP 17/1671', 'label' => 'Atuação ética e comprometida com o cuidado psicológico.'],
            ['kpi' => 'Escuta sensível', 'label' => 'Acolhimento de vivências femininas com respeito e profundidade.'],
            ['kpi' => 'Ressignificação', 'label' => 'Processo terapêutico voltado a novos sentidos para sua história.'],
        ],
    ],
    'moments' => [
        'title' => 'Para mulheres que buscam acolhimento e autoconhecimento',
        'text' => 'Este espaço nasce como um lugar de escuta, acolhimento e transformação. Meu propósito é ajudar mulheres a reencontrarem sua força, seu valor e sua essência através do autoconhecimento e do cuidado emocional. Aqui você pode se permitir ser quem é, sem julgamentos, com verdade, coragem e afeto.',
        'pills' => [
            ['icon' => 'chat-heart', 'label' => 'Acolhimento emocional'],
            ['icon' => 'emoji-neutral', 'label' => 'Autoestima e autovalor'],
            ['icon' => 'people', 'label' => 'Relações familiares e afetivas'],
            ['icon' => 'clipboard2-check', 'label' => 'Autoconhecimento'],
            ['icon' => 'journal-text', 'label' => 'Ressignificação de histórias'],
            ['icon' => 'calendar2-heart', 'label' => 'Reconexão com sua essência'],
        ],
    ],
    'services' => [
        'title' => 'Áreas de cuidado no atendimento psicológico',
        'text' => 'Atendimento individual com prática clínica voltada ao universo feminino, acolhimento e construção de novos recursos emocionais.',
        'items' => [
            ['icon' => 'chat-heart', 'title' => 'Atendimento psicológico para mulheres', 'text' => 'Espaço de escuta sensível para acolher vivências emocionais, conflitos internos e momentos de transição.'],
            ['icon' => 'emoji-neutral', 'title' => 'Ansiedade, insegurança e sobrecarga', 'text' => 'Acompanhamento para compreender gatilhos emocionais e desenvolver recursos de regulação e autocuidado.'],
            ['icon' => 'people', 'title' => 'Família e vínculos', 'text' => 'Suporte para relações familiares, afetivas e construção de limites com mais clareza e segurança.'],
            ['icon' => 'journal-text', 'title' => 'Ressignificação de histórias', 'text' => 'Processo terapêutico para revisar experiências, elaborar dores antigas e construir novos sentidos para sua trajetória.'],
            ['icon' => 'clipboard2-check', 'title' => 'Autoconhecimento e autoestima', 'text' => 'Fortalecimento da identidade, da autopercepção e da confiança para escolhas mais alinhadas com quem você é.'],
            ['icon' => 'person-lines-fill', 'title' => 'Acompanhamento contínuo', 'text' => 'Organização do processo terapêutico com presença, ética e continuidade no cuidado psicológico.'],
        ],
    ],
    'psychotherapy' => [
        'title' => 'Psicoterapia',
        'text' => 'Atendimento individual com escuta sensível para acolher emoções, fortalecer autoestima e construir novos recursos internos.',
    ],
    'couple_therapy' => [
        'title' => 'Terapia de Casal',
        'text' => 'Espaço terapêutico para casais que desejam melhorar comunicação, elaborar conflitos e fortalecer o vínculo com mais presença e respeito.',
        'items' => [
            ['icon' => 'chat-dots', 'title' => 'Comunicação no relacionamento', 'text' => 'Trabalho para reduzir ruídos, ampliar escuta e facilitar conversas importantes sem escalada de conflito.'],
            ['icon' => 'heart', 'title' => 'Reconexão afetiva', 'text' => 'Acompanhamento para lidar com distanciamento emocional, mágoas e desgaste da convivência.'],
            ['icon' => 'people', 'title' => 'Combinados do casal', 'text' => 'Construção de acordos práticos sobre rotina, limites e expectativas para uma relação mais equilibrada.'],
        ],
    ],
    'how' => [
        'title' => 'Como funciona o acompanhamento de um processo terapêutico.',
        'text' => 'Um acompanhamento terapêutico conduzido com clareza, acolhimento e sensibilidade, oferecendo suporte humanizado desde o primeiro contato até o final de cada etapa da sua jornada emocional.',
        'steps' => [
            'Você solicita o agendamento pelo formulário ou WhatsApp',
            'Jersika retorna para alinhar horário e orientações iniciais',
            'A primeira sessão acolhe sua história, momento atual e demandas principais',
            'O processo terapêutico define objetivos, frequência e combinados de cuidado',
            'As sessões acompanham sua evolução com foco em autoconhecimento e ressignificação',
        ],
        'details_title' => 'Quem é Jersika Carvalho',
        'details_badge' => 'Psicóloga',
        'bio' => 'Psicóloga dedicada ao universo feminino, com uma escuta sensível e uma prática voltada ao acolhimento, autoconhecimento e ressignificação de histórias.',
        'quote' => 'A terapia pode ser o caminho para reencontrar sua verdadeira essência.',
        'image' => [
            'src' => 'assets/img/hero/about/about-desktop-640.webp',
            'sources' => [
                ['path' => 'assets/img/hero/about/about-desktop-640.webp', 'width' => 640],
                ['path' => 'assets/img/hero/about/about-desktop-960.webp', 'width' => 960],
                ['path' => 'assets/img/hero/about/about-desktop-1086.webp', 'width' => 1086],
            ],
            'mobile' => [
                'src' => 'assets/img/hero/about/about-mobile-640.webp',
                'sources' => [
                    ['path' => 'assets/img/hero/about/about-mobile-640.webp', 'width' => 640],
                ],
                'sizes' => '92vw',
                'media' => '(max-width: 576px)',
                'width' => 640,
                'height' => 512,
            ],
            'alt' => 'Jersika Carvalho',
            'width' => 640,
            'height' => 512,
        ],
        'details' => [
            'Psicóloga — CRP 17/1671',
            'Formação em Psicologia Corporal',
            'Especialização em Família',
            'Especialização em Psicologia Analítica (em formação)',
            'Terapeuta de Mulheres (em formação)',
        ],
    ],
    'structure' => [
        'title' => 'Um espaço seguro para o cuidado emocional',
        'text' => 'Atendimento individual com privacidade, acolhimento e foco em uma escuta que respeita sua singularidade.',
        'cards' => [
            ['icon' => 'door-open', 'title' => 'Acolhimento desde o início', 'text' => 'Primeiro contato respeitoso, com orientação clara para que você se sinta segura para começar.'],
            ['icon' => 'shield-lock', 'title' => 'Privacidade e ética profissional', 'text' => 'Informações compartilhadas tratadas com sigilo e responsabilidade clínica.'],
            ['icon' => 'clipboard2-check', 'title' => 'Processo terapêutico estruturado', 'text' => 'Acompanhamento organizado com objetivos, continuidade e revisão da sua evolução emocional.'],
        ],
    ],
    'location' => [
        'title' => 'Localização',
        'eyebrow' => 'Salvador, BA',
        'address' => 'Atendimento psicológico com hora marcada',
        'description' => 'Espaço de atendimento da psicóloga Jersika Carvalho, com agenda organizada e ambiente reservado para conversas sensíveis.',
        'details' => [
            ['icon' => 'geo-alt', 'label' => 'Salvador, Bahia'],
            ['icon' => 'calendar2-check', 'label' => 'Atendimentos realizados mediante agendamento prévio'],
            ['icon' => 'shield-lock', 'label' => 'Ambiente reservado para conversas sensíveis'],
        ],
        'note' => 'Após o contato, a equipe confirma disponibilidade de horário e envia as orientações de chegada.',
        'primary_label' => 'Solicitar agendamento',
        'secondary_label' => 'Abrir rota',
        'map_embed_url' => 'https://maps.google.com/maps?center=-12.973049326932946,-38.44097323442949&q=-12.973049326932946,-38.44097323442949&z=16&output=embed',
        'map_link' => 'https://www.google.com/maps/search/?api=1&query=-12.973049326932946,-38.44097323442949&zoom=16',
        'iframe_title' => 'Mapa: atendimento psicológico com Jersika Carvalho (Salvador, BA)',
    ],
    'cta' => [
        'title' => 'Quero iniciar minha terapia',
        'text' => 'Preencha seus dados para receber retorno e alinhar o primeiro atendimento psicológico de forma acolhedora e organizada.',
        'primary_label' => 'Solicitar agendamento',
        'secondary_label' => 'Falar no WhatsApp',
        'helper_points' => [
            ['icon' => 'clock-history', 'label' => 'Retorno para alinhar horário e formato do primeiro encontro'],
            ['icon' => 'shield-lock', 'label' => 'Contato com discrição, ética e sigilo'],
            ['icon' => 'journal-check', 'label' => 'Espaço para aprofundar sua história na sessão'],
        ],
        'note' => 'Em situação de crise aguda ou risco imediato, procure apoio emergencial presencial na sua região.',
    ],
    'form' => [
        'title' => 'Solicite seu agendamento com a Jersika',
        'text' => 'Informe seus contatos e sua necessidade inicial. Você não precisa detalhar tudo agora: o aprofundamento acontece na sessão terapêutica.',
        'helper_points' => [
            [
                'icon' => 'chat-square-heart',
                'title' => 'Contato inicial simples',
                'text' => 'Compartilhe apenas o essencial para o agendamento. O restante pode ser trabalhado com calma na sessão.',
            ],
            [
                'icon' => 'calendar2-check',
                'title' => 'Primeiro encontro com clareza',
                'text' => 'O retorno e feito para organizar horario, formato e orientacoes do inicio do acompanhamento.',
            ],
            [
                'icon' => 'shield-lock',
                'title' => 'Sigilo e privacidade',
                'text' => 'Se preferir, deixe detalhes sensiveis para a sessao. O primeiro passo pode ser breve e seguro.',
            ],
        ],
        'fields' => [
            'name_label' => 'Nome completo',
            'phone_label' => 'Telefone / WhatsApp',
            'email_label' => 'Email',
            'message_label' => 'Motivo do contato',
            'message_placeholder' => 'Ex.: Quero iniciar terapia para trabalhar ansiedade, autoestima e questoes familiares.',
            'optional_summary' => 'Adicionar preferencia de horario ou observacoes praticas (opcional)',
            'optional_label' => 'Horario / observacoes praticas',
        ],
        'errors' => [
            'name' => 'Informe seu nome.',
            'phone' => 'Informe um telefone valido para contato.',
            'email' => 'Informe um email valido.',
            'message' => 'Descreva brevemente sua necessidade inicial.',
        ],
        'privacy_note' => 'Ao enviar, voce autoriza o uso dos dados informados para retorno sobre o agendamento psicologico. Evite relatar detalhes intimos ou sensiveis alem do necessario para o primeiro contato.',
    ],
    'faq' => [
        'title' => 'Dúvidas frequentes',
        'text' => 'Informações importantes antes de solicitar seu primeiro atendimento.',
        'items' => [
            [
                'question' => 'Quem é Jersika Carvalho?',
                'answer' => 'Jersika Carvalho é psicóloga (CRP 17/1671), dedicada ao universo feminino, com escuta sensível e prática voltada ao acolhimento, autoconhecimento e ressignificação de histórias.',
            ],
            [
                'question' => 'Qual é a formação da profissional?',
                'answer' => 'Psicóloga com formação em Psicologia Corporal, especialização em Família, especialização em Psicologia Analítica (em formação) e atuação como Terapeuta de Mulheres (em formação).',
            ],
            [
                'question' => 'Como funciona o primeiro atendimento?',
                'answer' => 'A primeira sessão acolhe sua história, momento atual e principais demandas. A partir disso, são alinhados os próximos passos do processo terapêutico.',
            ],
            [
                'question' => 'Preciso contar tudo no formulário?',
                'answer' => 'Não. Você pode enviar apenas as informações essenciais para contato e agendamento. O aprofundamento acontece no espaço terapêutico.',
            ],
            [
                'question' => 'Este site substitui atendimento de urgência?',
                'answer' => 'Não. O site é para contato e agendamento. Em caso de crise aguda, risco imediato ou urgência em saúde mental, procure atendimento emergencial presencial.',
            ],
        ],
    ],
    'footer' => [
        'title' => 'Jersika Carvalho',
        'label' => 'Psicóloga • CRP 17/1671',
        'address' => '',
        'meta' => 'Atendimento psicológico para mulheres • Psicologia Corporal • Especialização em Família • Psicologia Analítica (em formação) • Terapeuta de Mulheres (em formação)',
        'emergency_note' => 'Em caso de crise aguda, risco imediato ou urgência em saúde mental, procure atendimento emergencial presencial.',
    ],
    'floating_whatsapp' => [
        'label' => 'WhatsApp',
        'aria_label' => 'Falar no WhatsApp sobre atendimento psicológico',
    ],
];
