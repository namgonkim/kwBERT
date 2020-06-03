#!/usr/bin/python
#-*- coding: utf-8 -*-
import sys
import time
import os
from os.path import join

f = open('C:\\Users\\cine\\Desktop\\HanBert-54kN\\preprocess\\input_text.txt','r',encoding='utf-8')
f1 = open('C:\\Users\\cine\\Desktop\\HanBert-54kN\\data\\test.txt','w',encoding='utf-8')


# 문장을 형태소기준으로 split 윈도우일때 하는 방법 추가
import MeCab
mecab_tagger = MeCab.Tagger()
sentence = f.read()

def split_morph(sentence):
    return [
        node.split('\t')[0]
        for node in mecab_tagger.parse(sentence).split('\n')
    ][:-2]

def save_test(pre_data):
    strs.append('.')
    for i in range(0,len(strs)-1):
        if strs[i+1]=='년' or strs[i+1]=='월' or strs[i+1]=='일' or strs[i+1]=='시' or strs[i+1]=='분':
            f1.write(strs[i])
            continue
        else:
            f1.write(strs[i])
        f1.write(" O\n")
        
    if strs[len(strs)-1] != '.':
        f1.write(". O\n")
    f1.write("\n\n")

#print(sentence, split_morph(sentence))
strs = split_morph(sentence)
save_test(strs)


