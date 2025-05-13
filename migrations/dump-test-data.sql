SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE news;
TRUNCATE TABLE users;

SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO users (id, name) VALUES (1, 'Teszt Elek');
INSERT INTO users (id, name) VALUES (2, 'Nagy István');

INSERT INTO news (id, author_id, publish_at, title, short_content, content, image) VALUES (1, 1, '2025-05-12 08:00:00', 'What your ice cream eating style says about you, according to a psychologist', 'A recent study has revealed that the way you eat your favourite ice cream could be an insight into your personality, with psychologist Jo Hemmings revealing what it could mean', 'Are you a licker, biter, or nibbler when it comes to enjoying your ice cream? Well, experts reckon the way you eat the summer treat can reveal a lot about your personality type. Psychologist Jo Hemmings shares that your method of eating it might just give away whether you''re a risk-taker or more on the careful side.
A study by Nuii ice cream, which surveyed 2,000 ice cream lovers, showed that most of us prefer to lick our beloved ice cream, while a daring four in ten go for the bold bite - but what does this say about our personality?
Henry Craven from Nuii commented: "We all know that ice cream is a favourite treat for many of us but discovering the way the nation eats theirs has caused quite a debate."
Henry highlighted how a video of Brand Ambassador and Hollywood hunk Jason Momoa sinking his teeth into an ice cream got everyone talking. "The reaction inspired us to delve deeper into what your ice cream-eating style might say about your personality," Henry added.
Following the research, the brand also took to the streets to gauge public opinion on the matter. But what does your ice cream eating style say about you?
Behavioural psychologist Jo Hemmings reckons that those who chomp straight into their ice cream are usually ''fearless'', ''confident'' and ''impulsive'', seemingly not bothered by the threat of brain freeze. The study found that a good chunk of Brits agreed, labelling ice cream biters as ''impulsive'' (31%), ''confident'' (29%) and ''fearless'' (26%).
On the flip side, Jo suggests that those who prefer to lick their ice cream are ''methodical'' and ''relaxed'', showing patience and a knack for savouring every moment. These folks might also be hopeless romantics.
As for those who nibble and take their sweet time with their ice cream, Jo characterises them as more ''cautious'', ''gentle'' and ''thoughtful'', though they can sometimes come across as a tad controlling.
Hemmings explained further: "The ice cream lover''s psyche revolves around pleasure seeking and nostalgia. They will have a sweet tooth, and ice cream is one of the key comfort foods that may help them regulate their emotions."
"They are probably playful, imaginative, and get excited about all celebrations – from kids'' birthday parties to Easter and Christmas. They don''t see ice cream as something just to be eaten in the summer." In fact, two thirds admitted they enjoy ice cream no matter the weather.
Jo also pointed out that the speed at which you eat your ice cream can reveal a lot about your personality too. Jo reckons that quick eats, who makeup a third of adults, are: "likely to be high-energy, impulsive, enthusiastic and impatient. They want that dopamine hit as fast as possible."
She went on to say: "They may be restless and a bit edgy at times, using fast eating to soothe themselves." In contrast, "The slow-savourer is highly intentional and patient. They focus on the full sensory experience of eating ice cream – the texture, the flavour, the smell, the cold comfort."
Henry Craven from Nuii ice cream weighed in: "I''m sure some of the traits both Jo and the research link to ring home for some fans of these frozen treats. Regardless of how you eat yours, it''s all about enjoyment."', '1_woman_with_ice_creams.webp');

INSERT INTO news (id, author_id, publish_at, title, short_content, content, image) VALUES (2, 2, '2025-05-11 12:00:00', '''Molly-Mae effect'' sells out ''best moisturiser ever'' – but one brand still has it', 'Influencer and businesswoman Molly-Mae Hague has influenced the nation that hard that she can sell-out products that she features. It''s happened with this Fenty item - and you can still get it here...', 'Molly-Mae Hague recently shared how she gets such smooth and glowing skin - and it''s all thanks to another big wig celeb.
The influencer, 25, from Hertfordshire, has once again been sprung into the limelight after the second part of her Amazon Prime documentary ''Molly Mae: Behind It All'' dropped at the end of last week.
She finally confirmed that she is back with ex-fiancé Tommy Fury,25, who share daughter Bambi, two, together. Molly was not shy about letting fans into her private life in the six episode programme.
And the influencer is never shy about sharing her most-loved beauty and skincare picks of the moment. Over on her Instagram stories, to her 8.5million followers, Molly shared "one of the best body moisturisers" she has ever slathered her skin in.
She was gushing about the ''Fenty Skin Butta Drop Hydrating Body Milk'', from Rihanna''s brand Fenty Beauty. The brand has become a cult-favourite amongst makeup artists and beauty fans since it launch in 2017.
She wrote: "I can confidently say that this is one of the best body moisturisers I have ever used...and that''s a huge statement for me because I''ve tried and tested SO many over the years and especially through pregnancy.
"This soaks your skin immediately!!! I''ve never known a body moisturiser like it 11/10." The influencer shared her discount code ''MOLLYMAELF'' (to save £5) - but it quickly sold out on both LOOKFANTASTIC, Sephora and Boots thanks to the ''Molly Mae'' effect.
Good job it''s still in stock on the Fenty website, costing £28 for the standard 185ml size or £53 for the 500ml refill pouch.
So why is it such a big hit? Apart from the ''Molly-Mae'' effect, the ''milky'' moisture of the product is supposed to make your skin feel hydrated - not heavy like other moisturisers can do.
It''s also infused with bergamot, jasmine and white orchid, which should hopefully leave you smelling good as well as looking good.
Elsewhere, fans have been gushing over Molly Mae''s interior - that is influenced by ''Scandi'' minimalistic style. Despite her furniture being worth a small fortune, luxury interior brand DUSK shared some of their picks to get a Molly-Mae ''inspired'' home.
And, on the makeup front, Rihanna''s Fenty makeup artist revealed the look for the artist at the Met Gala. To no surprise, it''s all about the skin to get that red carpet ready look down to a T.', '1_woman_with_ice_creams.webp');

INSERT INTO news (id, author_id, publish_at, title, short_content, content, image) VALUES (3, 1, '2025-06-25 12:00:00', '''Victorian'' disease that toppled empires is now antibiotic resistant, experts warn', 'Typhoid fever is caused by a type of bacteria found in human waste and sewage, and is still a major problem in some parts of the world - but now the bacteria is becoming resistant to antibiotics', 'A deadly disease that once brought ancient empires to their knees is now getting tougher for antibiotics to tackle, reports say.
Typhoid fever lurks in certain regions and spreads very quickly. A whopping 110,000 lives are lost to this sickness annually, especially in places such as Southeast Asia, Sub-Saharan Africa, South America, and Eastern Europe.
As this old killer starts shrugging off antibiotics, alarm bells are ringing. An international team of researchers sounded off in Scientific Data journal recently: "Despite advances in vaccination and treatment strategies, typhoid fever continues to affect millions annually, leading to substantial morbidity and mortality, and there continue to be large-scale outbreaks."
The World Health Organisation (WHO) reckons around nine million people get smacked down by typhoid every year. Despite this, people still see typhoid as just being an old-timey Victorian bug. It even killed Prince Albert, Queen Victoria''s husband, in 1861.
However, the US alone racks up about 5,700 typhoid cases and lands 620 people in hospital each year. However, the Centres for Disease Control and Prevention, said that most folks catch it while holidaying abroad.
The National Health Service is flagging up that bacteria that causes typhoid can spread through your body and mess with your organs, and there are hundreds of cases clocked each year on UK soil.
The NHS site warns: "Most of these people become infected while visiting relatives in Bangladesh, India or Pakistan. But you''re also at risk if you visit Asia, Africa or South America."
Experts are sounding the alarm bells after fresh data emerged last month, revealing that Tuberculosis (TB) "remains a serious public health issue in England."
The boffins are blaming the "reemergence, re-establishment, and resurgence" of various diseases on the uptick in social hobnobbing and globe-trotting post-COVID-19 lockdowns.
The Salmonella Typhi bacteria are mutating to dodge antibiotics and science boffins have been eyeballing the strains recently to confirm this resistance.
Over at a clinic in northern Pakistan, clinical pharmacist Jehan Zeb Khan told The Guardian: "Typhoid was once treatable with a set of pills and now ends up with patients in hospital."
Typhoid typically shows as a nasty high fever, fatigue and gut-ache in about one to three weeks. However, symptoms can escalate to intestinal hemorrhage, organ failure and sepsis, and death.
Students at the University of Wisconsin–Madison have been warned about maybe contracting Salmonella Typhi in February after after a campus café worker was diagnosed with typhoid.', '3_rod-shaped-bacteria.webp');
