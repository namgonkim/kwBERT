import mecab
from tokenization_kobert import KoBertTokenizer
from os.path import join
import sys

f = open("/home/ask/PycharmProjects/DistilKoBERT/input.txt", 'r')
line = f.readline()
print (line)
f.close()

#sys.stdout = open("/home/ask/PycharmProjects/DistilKoBERT/result.txt", "w")
# f = open("/home/ask/PycharmProjects/DistilKoBERT/result.txt", 'w')

mecab = mecab.MeCab()

tokened_str = mecab.morphs(line)
print(tokened_str)
# f.write (' / '.join(tokened_str) + "\n")

tokened_str = mecab.nouns(line)
print(tokened_str)
# f.write (' / '.join(tokened_str) + "\n")

tokened_str = mecab.pos(line)
print(tokened_str)
# for i in tokened_str:
#     f.write('/'.join(i) + "  ")
# f.write("\n")

tokenizer = KoBertTokenizer.from_pretrained('monologg/kobert')
tokened_str = tokenizer.tokenize("[CLS]" + line + "[SEP]")
print(tokened_str)
# f.write(' / '.join(tokened_str) + "\n")

print(tokenizer.convert_tokens_to_ids(tokened_str))
str = "[" + ', '.join(str(e) for e in tokenizer.convert_tokens_to_ids(tokened_str)) + "]"
# f.write (''.join(str))
# f.close()

import torch
from kobert_transformers import get_distilkobert_model, get_kobert_model

model = get_distilkobert_model()
#input_ids = torch.LongTensor([[31, 51, 99, 12, 20, 55, 87]])
input_ids = torch.LongTensor([tokenizer.convert_tokens_to_ids(tokened_str)])
attention_mask = torch.LongTensor([[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]])
last_layer_hidden_state, _ = model(input_ids, attention_mask)
print (last_layer_hidden_state)



